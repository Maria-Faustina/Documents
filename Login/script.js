document.getElementsByClassName('form').addEventListener('submit'), function(event) {
    // 1. Impede o formulário de ser enviado e recarregar a página
    event.preventDefault();
}
function cadastro(){
    const name = document.getElementById('user').value;
    const email = document.getElementById('email').value.trim();
    const senha = document.getElementById('senha').value;
    const c_senha = document.getElementById('c_senha').value;
    
    if (senha =! c_senha){
        alert("As senhas não são iguais");
    }
    else if(senha.leight > 6){
        alert("Senha deve conter no minimo 6 caracteres");
    }
    else{
        alert("Cadastro feito com sucesso!");
        location.href = "login.html";
    }
}

function login(email, senha, user){
    const email_c = document.getElementById('email').value;
    const senha_c = document.getElementById('senha').value;

    if(email_c == email || user || 'adm' && senha_c == senha || 'adm'){
        alert("Login realizado com sucesso! ");
        location.href = 'index.html';
    }
    else{
        alert("Usuario ou senha incorreta!");
    }
}
