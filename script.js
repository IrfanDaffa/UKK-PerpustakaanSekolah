document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function(e) {
        e.preventDefault();
    
        document.querySelector(this.getAttribute('href')).scrollIntoView({
            behavior: 'smooth'
        });
    });
});

const modal = document.getElementById('borrow-modal');
const btn = document.querySelectorAll('.borrow-now')[0];
const span = document.getElementsByClassName('close')[0];

btn.onclick = function() {
    modal.style.display = 'block';
}

span.onclick = function() {
    modal.style.display = 'none';
}

window.onclick = function (event) {
    if (event.target == modal) {
        modal.style.display = 'none';
    }
}

document.getElementById('borrow-form').addEventListener('submit', function(e) {
    e.preventDefault();
    const nama = document.getElementById('nama').value;
    const kelas = document.getElementById('kelas').value;
    const judul_buku = document.getElementById('judul_buku').value;
    const tanggal_peminjaman = document.getElementById('tanggal_peminjaman').value;
    
    if (nama === ''|| kelas === '') {
        alert('Nama dan kelas wajib diisi!');
    } else {
        alert('Terima kasih telah menghubungi kami, ' + nama + '!');
        modal.style.display = 'none';
    }
});