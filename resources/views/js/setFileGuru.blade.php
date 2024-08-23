<script>
    document.addEventListener('DOMContentLoaded', function() {
        const guru = @json($guru);
        const namaGuru = guru.nama.toLowerCase().replace(/ /g, '_');
        const ijazahs = guru.ijazah;

        ijazahs.forEach(ijazah => {
            const jenisIjazah = ijazah.jenis_ijazah.toLowerCase();
            const inputElement = document.querySelector(`input[name="ijazah_${jenisIjazah}"]`);

            if (inputElement) {
                console.log(ijazah.nama_file)
                const url = `${window.location.protocol}//${window.location.hostname}:${window.location.port}/${ijazah.nama_file}`;
                // const filePath = `/img/guru/${namaGuru}/ijazah/${ijazah.nama_file}`;

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

        const setFileInput = (filePath, inputName) => {
            if (filePath) {
                const url = `${window.location.protocol}//${window.location.hostname}:${window.location.port}/${filePath}`;
                const inputElement = document.querySelector(`input[name="${inputName}"]`);
                if (inputElement) {

                    fetch(url)
                        .then(response => response.blob())
                        .then(blob => {
                            const file = new File([blob], filePath, {
                                type: blob.type,
                                lastModified: new Date(),
                            });

                            const dataTransfer = new DataTransfer();
                            dataTransfer.items.add(file);
                            inputElement.files = dataTransfer.files;
                        })
                        .catch(error => console.error('Error fetching file:', error));
                }
            }
        };

        const setFileInputMultiple = async (files, inputName, namaGuru) => {

            if (files && files.length > 0) {
                const inputElement = document.querySelector(`input[name="${inputName}"]`);
                if (inputElement) {
                    const dataTransfer = new DataTransfer();

                    for (const fileData of files) {
                        const fileName = fileData.nama_file;
                        const extractedFileName = fileName.substring(fileName.indexOf('-') + 1);

                        const filePath =`/img/guru/${namaGuru}/sertifikat/Sertifikat${extractedFileName}`;

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

        setFileInput(guru.foto, 'foto');
        setFileInput(guru.foto_ktp, 'foto_ktp');
        setFileInput(guru.foto_surat_keterangan_mengajar, 'foto_surat_keterangan_mengajar');
        setFileInputMultiple(guru.sertifikat, 'foto_sertifikat[]', namaGuru)
    });
</script>
