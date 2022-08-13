const xhttp = new XMLHttpRequest();

// Handle Tambah
const handleTambah = (e) => {
  let kuis = e.parentElement.querySelector("textarea").value;
  let pilihan_4 = document.querySelector("#pilihan_1").value;
  let pilihan_3 = document.querySelector("#pilihan_2").value;
  let pilihan_2 = document.querySelector("#pilihan_3").value;
  let pilihan_1 = document.querySelector("#pilihan_4").value;

  if (kuis !== "") {
    xhttp.onload = function () {
      const modal = document.querySelector(".show");
      let result = JSON.parse(this.response);

      modal.classList.remove("show");
      modal.querySelector("textarea").value = "";

      loadKuis();

      if (result.success) {
        alert("Berhasil");
      } else {
        alert("Gagal");
      }
    };
    xhttp.open("POST", "api/tambah_kuis.php");
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send(
      `kuis=${kuis}&pilihan_1=${pilihan_1}&pilihan_2=${pilihan_2}&pilihan_3=${pilihan_3}&pilihan_4=${pilihan_4}`
    );
  }
};

// Handle Simpan Edit
const handleUbah = (e) => {
  let kuis = e.parentElement.querySelector("textarea").value;
  let pilihan_4 = document.querySelector("#edit-pilihan_1").value;
  let pilihan_3 = document.querySelector("#edit-pilihan_2").value;
  let pilihan_2 = document.querySelector("#edit-pilihan_3").value;
  let pilihan_1 = document.querySelector("#edit-pilihan_4").value;

  if (kuis !== "") {
    xhttp.onload = () => {
      const modal = document.querySelector(".show");
      modal.classList.remove("show");
      modal.querySelector("textarea").value = "";

      loadKuis();
    };
    xhttp.open("POST", "api/edit_kuis.php");
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send(
      `kuis=${kuis}&id_kuis=${e.id}&pilihan_1=${pilihan_1}&pilihan_2=${pilihan_2}&pilihan_3=${pilihan_3}&pilihan_4=${pilihan_4}`
    );
  }
};

// Handle Hapus
const handleHapus = (e) => {
  let linkApi = link + e.id;
  if (e.id) {
    xhttp.onload = function () {
      let result = JSON.parse(this.response);
      loadKuis();

      if (result.success) {
        alert("Berhasil");
      } else {
        alert("Gagal");
      }
    };
    xhttp.open("GET", linkApi);
    xhttp.send();

    document.querySelector(".show").classList.remove("show");
  }
};

// Handle Batal
const buttonBatals = document.querySelectorAll("button.batal");
buttonBatals.forEach((btn) => {
  btn.addEventListener("click", () => {
    let button = document.querySelector(".show");
    if (button) {
      document.querySelector(".show").classList.remove("show");
    }
  });
});