<script>
    function getData(namaVariabel) {
        document.addEventListener('DOMContentLoaded', function() {
            const data =
                namaVariabel

            // Function to set multiple file inputs
            const setFileInputMultiple = async (files, inputName) => {
                if (files && files.length > 0) {
                    // Hilangkan karakter escape dan parsing string JSON menjadi array
                    const parsedFiles = JSON.parse(files.replace(/\\/g, ''));

                    const inputElement = document.querySelector(`input[name="${inputName}"]`);
                    if (inputElement) {
                        const dataTransfer = new DataTransfer();

                        for (const fileData of parsedFiles) {
                            console.log(fileData)
                            const url =
                                `${window.location.protocol}//${window.location.hostname}:${window.location.port}/storage/${fileData}`;
                            try {
                                const response = await fetch(url);
                                if (!response.ok) {
                                    throw new Error('Network response was not ok');
                                }
                                const blob = await response.blob();

                                const file = new File([blob], fileData, {
                                    type: blob.type,
                                    lastModified: new Date(),
                                });

                                dataTransfer.items.add(file);
                            } catch (error) {
                                console.error(`Error fetching file ${fileData}:`, error);
                            }
                        }

                        inputElement.files = dataTransfer.files;
                    }
                }
            };


            setFileInputMultiple(data.dokumentasi, 'dokumentasi[]');
            setFileInputMultiple(data.undangan, 'undangan[]');
        });
    }

    function getDataSingle(namaVariabel) {
        const data = namaVariabel
        console.log(data)
    const setFileInput = async (fileName, inputName) => {
        if (fileName) {
            const url = `${window.location.protocol}//${window.location.hostname}:${window.location.port}/storage/${fileName}`;
            const inputElement = document.querySelector(`input[name="${inputName}"]`);
            if (inputElement) {

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
    setFileInput(data.juz_30, 'juz_30')
    setFileInput(data.juz_29, 'juz_29')
    setFileInput(data.juz_28, 'juz_28')
    setFileInput(data.juz_umum, 'juz_umum')
    }
</script>
