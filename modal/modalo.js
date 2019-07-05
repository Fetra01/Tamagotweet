// Get the modal
var modal = document.getElementById("id01");

// Get the button that opens the modal
var btn = document.getElementById("myBtn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];
var compteur = 0;
// When the user clicks on the button, open the modal
function affiche() {
  compteur++;

  if (compteur ==5)
  {
  modal.style.display = "block";
  compteur=0;


  }
                   }

// When the user clicks on <span> (x), close the modal
function enlever() {
  modal.style.display = "none";
  compteur = 0;
}

 /*// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}*/
