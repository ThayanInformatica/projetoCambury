

/* Atribui ao evento change do input FILE para upload da foto*/
var inputFile = document.getElementById("foto");
var foto_cliente = document.getElementById("foto-cliente");
if (inputFile != null && inputFile.addEventListener) {                   
    inputFile.addEventListener("change", function(){loadFoto(this, foto_cliente)});
} else if (inputFile != null && inputFile.attachEvent) {                  
    inputFile.attachEvent("onchange", function(){loadFoto(this, foto_cliente)});
}

function loadFoto(file, img){
	if (file.files && file.files[0]) {
		var reader = new FileReader();

		reader.onload = function (e) {
			img.src = e.target.result;
		}
		reader.readAsDataURL(file.files[0]);
	}
}
