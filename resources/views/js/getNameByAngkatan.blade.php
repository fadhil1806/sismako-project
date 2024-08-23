<script>
    document.getElementById('angkatan-select').addEventListener('change', function() {
        const angkatan = this.value;
        const namesSelect = document.getElementById('nama-select');
        namesSelect.innerHTML = '<option value="">-- Pilih Nama --</option>';

        // Fetch the student names based on the selected angkatan
        fetch(`/api/siswa?angkatan=${angkatan}`)
            .then(response => response.json())
            .then(data => {
                data.forEach(siswa => {
                    const option = document.createElement('option');
                    option.value = siswa.id;
                    console.log(siswa)
                    option.textContent = siswa.nama;
                    namesSelect.appendChild(option);
                });
            })
            .catch(error => console.error('Error fetching names:', error));
    });
</script>
