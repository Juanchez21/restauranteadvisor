/***
***SCRIPTS DE FUNCIONES ESPECIFICAS ***
***/
function actualizar(idRestaurante, idParams) {
	var port = 0;
	if ($("#portada"+idParams).is(":checked"))
		port = 1;
	var url = "/include/actualizarPortada.php?id="+idRestaurante+"&portada="+port+"&orden="+$("#orden"+idParams).val();
	$.get(url,actualiza);
}

function actualiza(data, status){
	if (status == "success") 
		alert("Se ha actualizado correctamente la portada." + data[0]);
	else
		alert("Ha surgido un error. La página va a recargarse.");
		
	location.reload();
}

function goLogin(){
	location.replace("/login.php");
}

function goRegister(){
	location.replace("/registro.php");
}

function goAddUser() {
	location.replace("/registro.php?add=1");
}