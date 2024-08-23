<script>
    document.addEventListener('DOMContentLoaded', function() {
        const tendik =
        @json($tendik); // Assuming $tendik is properly passed from Laravel with JSON encoding
        const namatendik = tendik.nama.toLowerCase().replace(/ /g, '_');
        const ijazahs = tendik.ijazah;

        ijazahs.forEach(ijazah => {
            const jenisIjazah = ijazah.jenis_ijazah;
            const inputElement = document.querySelector(`input[name="ijazah_${jenisIjazah}"]`);

            if (inputElement) {
                const url =
                    `${window.location.protocol}//${window.location.hostname}:${window.location.port}/${ijazah.nama_file}`;

                fetch(url)
                    .then(response => response.blob())
                    .then(blob => {
                        const file = new File([blob], ijazah.nama_file, {
                            type: blob.type,
                            lastModified: new Date(),
                        });

                        const dataTransfer = new DataTransfer();
                        dataTransfer.items.add(file);
                        inputElement.files = dataTransfer.files;
                    })
                    .catch(error => console.error('Error fetching file:', error));
            }
        });

        // Function to set a single file input
        const setFileInput = async (fileName, inputName) => {
            if (fileName) {
                const inputElement = document.querySelector(`input[name="${inputName}"]`);
                if (inputElement) {
                    const url =
                        `${window.location.protocol}//${window.location.hostname}:${window.location.port}/${fileName}`;
                    console.log(url)
                    // const filePath = `/img/tendik/${namatendik}/${fileName}`;

                    try {
                        const response = await fetch(url);
                        if (!response.ok) {
                            throw new Error('Network response was not ok');
                        }
                        const blob = await response.blob();

                        const file = new File([blob], fileName, {
                            type: blob.type,
                            lastModified: new Date(),
                        });
                        // console.log(file)

                        const dataTransfer = new DataTransfer();
                        dataTransfer.items.add(file);
                        inputElement.files = dataTransfer.files;
                    } catch (error) {
                        console.error(`Error fetching file ${fileName}:`, error);
                    }
                }
            }
        };

        // Function to set multiple file inputs
        const setFileInputMultiple = async (files, inputName, namatendik) => {
            if (files && files.length > 0) {
                const inputElement = document.querySelector(`input[name="${inputName}"]`);
                if (inputElement) {
                    const dataTransfer = new DataTransfer();

                    for (const fileData of files) {
                        const fileName = fileData.nama_file;
                        console.log(fileName)
                        const filePath = `/img/tendik/${namatendik}/sertifikat/${fileName}`;

                        try {
                            const response = await fetch(`/${fileName}`);
                            if (!response.ok) {
                                throw new Error('Network response was not ok');
                            }
                            const blob = await response.blob();

                            const file = new File([blob], fileName, {
                                type: blob.type,
                                lastModified: new Date(),
                            });

                            dataTransfer.items.add(file);
                        } catch (error) {
                            console.error(`Error fetching file ${fileName}:`, error);
                        }
                    }

                    inputElement.files = dataTransfer.files;
                }
            }
        };

        // Set single file inputs
        setFileInput(tendik.foto, 'foto');
        setFileInput(tendik.foto_ktp, 'foto_ktp');
        setFileInput(tendik.foto_surat_keterangan_mengajar, 'foto_surat_keterangan_mengajar');

        // Set multiple file inputs for sertifikat
        setFileInputMultiple(tendik.sertifikat, 'foto_sertifikat[]', namatendik);
    });
</script>
