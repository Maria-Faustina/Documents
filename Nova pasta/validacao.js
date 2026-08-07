function validarCadastro(event) {
    const senha = document.getElementById('senha').value;
    const c_senha = document.getElementById('c_senha').value;
    
    if (senha.length < 6) {
        alert("Sua senha deve conter no mínimo 6 caracteres para sua segurança.");
        event.preventDefault(); 
        return false;
    }
    
    if (senha !== c_senha) {
        alert("As senhas digitadas não são iguais. Tente novamente.");
        event.preventDefault(); 
        return false;
    }
    return true; 
}

function validarLogin(event) {
    const email = document.getElementById('email').value.trim();
    const senha = document.getElementById('senha').value;

    if(email === "" || senha === "") {
        alert("Por favor, preencha todos os campos.");
        event.preventDefault();
        return false;
    }
    
    return true;
}