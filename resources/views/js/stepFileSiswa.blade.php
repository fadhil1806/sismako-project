<script>
    document.addEventListener('DOMContentLoaded', function() {
    const siswa = @json($siswa);
    const namaSiswa = siswa.nama.toLowerCase().replace(/ /g, '_');

    // Function to set a single file input
    const setFileInput = async (fileName, inputName) => {
        if (fileName) {
            const url = `${window.location.protocol}//${window.location.hostname}:${window.location.port}${fileName}`;
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

    // Set single file inputs
    setFileInput(siswa.path_ijazah, 'ijazah')
    setFileInput(siswa.path_surat_Kelulusan, 'surat_Kelulusan')
    setFileInput(siswa.path_kk, 'kk')
    setFileInput(siswa.path_akta_kelahiran, 'akta_kelahiran');
    setFileInput(siswa.path_surat_pernyataan_calonPesertaDidik, 'surat_pernyataan_calonPesertaDidik');
    setFileInput(siswa.path_surat_pernyataan_wali, 'surat_pernyataan_wali');
    setFileInput(siswa.path_surat_pernyataan_tidak_merokok, 'surat_pernyataan_tidak_merokok')

    siswa.rapot_siswa.forEach(v => {
        if(v.rapot_kelas == 'VII') setFileInput(v.path_file, 'rapot_kelas7')
        if(v.rapot_kelas == "VIII") setFileInput(v.path_file, 'rapot_kelas8')
        if(v.rapot_kelas == 'IX') setFileInput(v.path_file, 'rapot_kelas9')
    })

    siswa.foto_siswa.forEach(v => {
        if(v.jenis_foto == 'X') setFileInput(v.path_file, 'foto_kelas10')
        if(v.jenis_foto == "XI") setFileInput(v.path_file, 'foto_kelas11')
        if(v.jenis_foto == 'XII') setFileInput(v.path_file, 'foto_kelas12')
    })

});

  </script>
