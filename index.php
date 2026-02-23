<?php
if (isset($_GET['url'])) {
    include $_GET['url'] . ".php";
    exit;
}
?>
 
<!DOCTYPE html>
<html>
<head>
    <title>Escola - Muitos para Muitos</title>
</head>
<body>
 
<h1>Escola - CRUD Completo</h1>
 
<h2>Aluno</h2>
<input type="hidden" id="alunoId">
Nome: <input type="text" id="nomeAluno">
Email: <input type="email" id="emailAluno">
<button onclick="salvarAluno()">Salvar</button>
<ul id="listaAlunos"></ul>
 
<hr>
 
<h2>Curso</h2>
<input type="hidden" id="cursoId">
Nome: <input type="text" id="nomeCurso">
<button onclick="salvarCurso()">Salvar</button>
<ul id="listaCursos"></ul>
 
<hr>
 
<h2>Matricular</h2>
<select id="selectAluno"></select>
<select id="selectCurso"></select>
<button onclick="matricular()">Matricular</button>
<ul id="listaMatriculas"></ul>
 
<script>
 
// ================= ALUNO =================
 
function salvarAluno(){
    let id = document.getElementById("alunoId").value;
    let nome = document.getElementById("nomeAluno").value;
    let email = document.getElementById("emailAluno").value;
 
    let metodo = id ? "PUT" : "POST";
 
    fetch("index.php?url=aluno", {
        method: metodo,
        headers: {"Content-Type": "application/json"},
        body: JSON.stringify({ id, nome, email })
    })
    .then(res => res.json())
    .then(() => {
        limparAluno();
        listarAlunos();
        carregarSelects();
    });
}
 
function listarAlunos(){
    fetch("index.php?url=aluno")
    .then(res => res.json())
    .then(data => {
        let lista = document.getElementById("listaAlunos");
        lista.innerHTML = "";
        data.forEach(a => {
            lista.innerHTML += `
                <li>
                    ${a.nome}
                    <button onclick="editarAluno(${a.id}, '${a.nome}', '${a.email}')">Editar</button>
                    <button onclick="excluirAluno(${a.id})">Excluir</button>
                </li>
            `;
        });
    });
}
 
function editarAluno(id, nome, email){
    document.getElementById("alunoId").value = id;
    document.getElementById("nomeAluno").value = nome;
    document.getElementById("emailAluno").value = email;
}
 
function excluirAluno(id){
    fetch("index.php?url=aluno&id="+id, { method:"DELETE" })
    .then(() => {
        listarAlunos();
        carregarSelects();
    });
}
 
function limparAluno(){
    document.getElementById("alunoId").value = "";
    document.getElementById("nomeAluno").value = "";
    document.getElementById("emailAluno").value = "";
}
 
// ================= CURSO =================
 
function salvarCurso(){
    let id = document.getElementById("cursoId").value;
    let nome = document.getElementById("nomeCurso").value;
 
    let metodo = id ? "PUT" : "POST";
 
    fetch("index.php?url=curso", {
        method: metodo,
        headers: {"Content-Type": "application/json"},
        body: JSON.stringify({ id, nome })
    })
    .then(() => {
        limparCurso();
        listarCursos();
        carregarSelects();
    });
}
 
function listarCursos(){
    fetch("index.php?url=curso")
    .then(res => res.json())
    .then(data => {
        let lista = document.getElementById("listaCursos");
        lista.innerHTML = "";
        data.forEach(c => {
            lista.innerHTML += `
                <li>
                    ${c.nome}
                    <button onclick="editarCurso(${c.id}, '${c.nome}')">Editar</button>
                    <button onclick="excluirCurso(${c.id})">Excluir</button>
                </li>
            `;
        });
    });
}
 
function editarCurso(id, nome){
    document.getElementById("cursoId").value = id;
    document.getElementById("nomeCurso").value = nome;
}
 
function excluirCurso(id){
    fetch("index.php?url=curso&id="+id, { method:"DELETE" })
    .then(() => {
        listarCursos();
        carregarSelects();
    });
}
 
function limparCurso(){
    document.getElementById("cursoId").value = "";
    document.getElementById("nomeCurso").value = "";
}
 
// ================= MATRÍCULA =================
 
function matricular(){
    fetch("index.php?url=aluno_curso", {
        method:"POST",
        headers: {"Content-Type":"application/json"},
        body: JSON.stringify({
            aluno_id: document.getElementById("selectAluno").value,
            curso_id: document.getElementById("selectCurso").value
        })
    })
    .then(() => listarMatriculas());
}
 
function listarMatriculas(){
    fetch("index.php?url=aluno_curso")
    .then(res => res.json())
    .then(data => {
        let lista = document.getElementById("listaMatriculas");
        lista.innerHTML = "";
        data.forEach(m => {
            lista.innerHTML += `
                <li>
                    ${m.aluno} - ${m.curso}
                    <button onclick="excluirMatricula(${m.aluno_id}, ${m.curso_id})">Excluir</button>
                </li>
            `;
        });
    });
}
 
function excluirMatricula(aluno_id, curso_id){
    fetch("index.php?url=aluno_curso&aluno_id="+aluno_id+"&curso_id="+curso_id, {
        method:"DELETE"
    })
    .then(() => listarMatriculas());
}
 
function carregarSelects(){
    fetch("index.php?url=aluno")
    .then(res => res.json())
    .then(data => {
        let s = document.getElementById("selectAluno");
        s.innerHTML="";
        data.forEach(a => s.innerHTML += `<option value="${a.id}">${a.nome}</option>`);
    });
 
    fetch("index.php?url=curso")
    .then(res => res.json())
    .then(data => {
        let s = document.getElementById("selectCurso");
        s.innerHTML="";
        data.forEach(c => s.innerHTML += `<option value="${c.id}">${c.nome}</option>`);
    });
}
 
listarAlunos();
listarCursos();
listarMatriculas();
carregarSelects();
 
</script>
 
</body>
</html>