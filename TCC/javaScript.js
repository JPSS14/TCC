function validarForm(){
    var nomeCompleto = formCadastro.nome_completo.value;
    var usuario = formCadastro.usuario.value;
    var email = formCadastro.email.value;
    var senha = formCadastro.senha.value;
    
    if(nomeCompleto == ""){
        alert ("Campo nome completo é obrigatório!");
        formCadastro.nome_completo.focus();
        return false;
    }
    
    if(usuario==""){
        alert ("Campo usuario é obrigatório!");
        formCadastro.usuario.focus();
        return false;
    }
    
    if(email==""){
        alert ("Campo email é obrigatório!");
        formCadastro.email.focus();
        return false;
    }
    
    if(senha==""){
        alert ("Campo senha é obrigatório!");
        formCadastro.senha.focus();
        return false;
    }
}