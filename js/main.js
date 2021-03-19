class enviarFormularios {

    async enviarForm(form, url) {
        const formdata = new FormData(form)
        const envio = await fetch(url, {
            method: 'POST',
            body: formdata
        })
        const respuesta = await envio.json()
        return respuesta
    }

}

//Instancia de clase envio de datos a taves de ajax
const formularios = new enviarFormularios()

// Enviar datos del reggistro --formulario--
registro.addEventListener("submit", async (e) => {
    e.preventDefault()
    const resp = await formularios.enviarForm(registro, 'modulos/procesos/register.php')
    if(resp.status === "ok"){
        registro.reset()
        respuestaRegistro.textContent = "Registro realizado con exito"
    }else if(resp.status === "error"){
        respuestaRegistro.textContent = resp.msg
    }
})

// Enviar datos del login --formulario--
login.addEventListener("submit", async (e) => {
    e.preventDefault()
    let resp = await formularios.enviarForm(login, 'modulos/procesos/login.php')
    if(resp.status == "ok"){
        window.location = "home.php"
    }else if(resp.status === "error"){
        respuestaLogin.textContent = resp.msg
    }
})