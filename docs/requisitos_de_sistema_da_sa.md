**SA  \- Sistema Ferroviário**

**Mockup: [https://canva.link/hdhx47pblaao8z3](https://canva.link/hdhx47pblaao8z3)**

**Regras de Negócio:**

RN 1 \- O usuário deve estar logado no sistema para utilizá-lo  
RN 2 \- O banco de dados deve ser feito no MySQL Workbench conforme o diagrama de entidade-relacionamento.  
RN 3 \- O administrador deve ter uma tela própria para ele, tendo opções para sair do sistema, ver os sensores cadastrados contendo ID do sensor, localização, tipo de dado, exclusão e vizualizar mais detalhes.  
RN 4 \- Ao excluir um sensor deve haver uma tela de confirmação e caso o sensor tenha dados associados não será possível excluí-lo.  
RN 5 \- O usuário deve poder gerenciar e visualizar gráficos a partir de relatórios gerados sobre a operação ferroviária  
RN 6 \- O sistema deve ter uma documentação explicando sobre a empresa em uma aba de Suporte

**Requisitos Funcionais:**   
RF 1 \- O sistema deve permitir fazer login com e-mail e senha   
RF 2 \- O sistema deve permitir cadastrar, listar e excluir trens e sensores  
RF 3 \- O sistema deve mostrar velocidade, localização e status operacional (normal, alerta, falha)  
RF 4 \- O sistema deve impedir o exclusão de sensores que tem dados registrados  
RF 5 \- O sistema deve gerar gráficos de desempenho e análise de tendências  
RF 6 \- O sistema deve receber e registrar dados vindos dos sensores IoT  
RF 7 \- O sistema deve ter uma aba de Suporte

**Requisitos Não Funcionais:**

RNF1 \- O sistema deve responder a tela de login em até 3 segundos  
RNF2 \- O sistema deve ter ao menos um simples sistema de segurança.   
RNF3 \- O sistema deve ser rápido e responder comandos de forma dinâmica.  
RNF4 \- O sistema deve ser responsivo a qualquer tela e dispositivo.

