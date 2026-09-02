# SA-FERRORAMA
**Desenvolvimento de um software para visualização, monitoramento e gerenciamento de dados gerados por sensores ferroviários em tempo real.**

---


## Proposta
O SA-FERRORAMA é um sistema voltado para a visualização, monitoramento e gerenciamento de dados de sensores aplicados em trens.

A proposta do projeto é centralizar as informações captadas pelos sensores em uma interface moderna e intuitiva, permitindo melhor acompanhamento dos dados e facilitando a administração dos dispositivos ferroviários.

---

## O Sistema conterá:
* Login de usuários
* Cadastro de usuários
* Visualização dos Dados dos Sensores em tempo real
* Edição de informações dos sensores
* Gerenciamento dos dados recebidos
* Edição de Sensores
* Edição de Trens
* Associação entre trens e sensores
* Autenticação

---

## Estrutura do Projeto

```text
├── assets/
│   ├── fonts/
│   └── images/
│
├── docs/
│   ├── pesquisa Sobre Xampp.md
│   ├── pesquisa_sobre_php_e_crud.md
│   ├── pesquisa_sobre_scrum.md
│   └── requisitos_de_sistema_da_sa.md
│
├── public/
│   ├── home.html
│   ├── monitoramento.html
│   ├── sensores.html
│   └── usuarios.html
│
├── scripts/
│   └── script.js
│
├── styles/
│   └── style.css
│
├── index.html
├── LICENSE
└── README.md
```

## Tecnologias Utilizadas:

<p align="center">
  <img src="https://img.shields.io/badge/HTML5-E34F26?style=for-the-badge&logo=html5&logoColor=white" alt="HTML5">
  <img src="https://img.shields.io/badge/CSS3-1572B6?style=for-the-badge&logo=css3&logoColor=white" alt="CSS3">
  <img src="https://img.shields.io/badge/Java-ED8B00?style=for-the-badge&logo=openjdk&logoColor=white" alt="Java">
  <img src="https://img.shields.io/badge/Bootstrap-7952B3?style=for-the-badge&logo=bootstrap&logoColor=white" alt="Bootstrap">
  <img src="https://img.shields.io/badge/Font_Awesome-528DD7?style=for-the-badge&logo=fontawesome&logoColor=white" alt="Font Awesome">
  <img src="https://img.shields.io/badge/Chart.js-FF6384?style=for-the-badge&logo=chartdotjs&logoColor=white" alt="Chart.js">
</p>

## Caso de Uso:
```mermaid
flowchart LR

    Administrador((Administrador))
    

    subgraph Sistema["SA - Sistema Ferroviário"]
        UC1([Cadastrar Usuários])
        UC2([Editar Usuários])
        UC3([Excluir Usuários])
        UC4([Listar Usuários])
        UC5([Cadastrar Sensores])
        UC6([Editar Sensores])
        UC7([Excluir Sensores])
        UC8([Listar Sensores])
        
    end

    Administrador --> UC1
    Administrador --> UC2
    Administrador --> UC3
    Administrador --> UC4
    Administrador --> UC5
    Administrador --> UC6
    Administrador --> UC7
    Administrador --> UC8
```
## Licença
Este projeto está sob a licença MIT.  
Consulte o arquivo `LICENSE` para mais informações.
