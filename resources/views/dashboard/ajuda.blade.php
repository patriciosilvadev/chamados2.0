@extends('layouts.dashboard.index')

@section('title', '| Ajuda')

@section('content')
<div class="container">
    <div class="row mb-3">
        <div class="col-md-12">
            <h3 class="text-center">Ajuda</h3>
        </div>
        <div class="col-md-12">
            <h5 class="text-left">Índice</h5>
            <div class="list-group list-group-flush">
                <a class="list-group-item" href="#1.abrir_chamado"><span class="indice">1. Abrir Chamado</span></a>
                <a class="list-group-item" href="#1.1.locais"><span class="sub-indice">1.1. Locais</span></a>
                <a class="list-group-item" href="#1.2.servicos"><span class="sub-indice">1.2. Serviços</span></a>
                <a class="list-group-item" href="#1.2.1.recorrencia"><span class="sub-indice-1">1.2.1. Recorrência</span></a>
                <a class="list-group-item" href="#1.3.detalhes"><span class="sub-indice">1.3. Detalhes</span></a>
                <a class="list-group-item" href="#2.lista_chamados"><span class="indice">2. Lista de Chamados</span></a>
                <a class="list-group-item" href="#2.1.niveis"><span class="sub-indice">2.1. Níveis de Visualização</span></a>
                <a class="list-group-item" href="#2.2.filtros"><span class="sub-indice">2.2. Filtros</span></a>
                <a class="list-group-item" href="#2.3.visualizacao_rapida"><span class="sub-indice">2.3. Visualização Rápida</span></a>
                <a class="list-group-item" href="#2.4.pagina_gestao"><span class="sub-indice">2.4. Página de Gestão/Visualização Completa</span></a>
                <a class="list-group-item" href="#2.4.1.detalhes"><span class="sub-indice-1">2.4.1. Detalhes</span></a>
                <a class="list-group-item" href="#2.4.2.descricao"><span class="sub-indice-1">2.4.2. Descrição</span></a>
                <a class="list-group-item" href="#2.4.3.mao_de_obra"><span class="sub-indice-1">2.4.3. Mão de Obra</span></a>
                <a class="list-group-item" href="#2.4.4.observacoes"><span class="sub-indice-1">2.4.4. Observações</span></a>
                <a class="list-group-item" href="#2.4.5.status"><span class="sub-indice-1">2.4.5. Status</span></a>
                <a class="list-group-item" href="#3.relatorios"><span class="indice">3. Relatórios</span></a>
                <a class="list-group-item" href="#4.os_avulsa"><span class="indice">4. OS Avulsa</span></a>
                <a class="list-group-item" href="#5.suporte"><span class="indice">5. Suporte</span></a>
            </div>
        </div>
    </div>
    <div class="row mb-5">
        <div class="col-md-12">
            <h4 id="1.abrir_chamado">1. Abrir Chamado</h4>
            <img src="{{ asset('img/manual/abrir_chamado.png') }}" alt="abrir chamado" class="img-fluid">
            <p class="text-justify">O menu “Abrir Chamado” estará acessível para todos os colaboradores que já tenham acessado o endereço <a href="http://masp.museu">http://masp.museu</a>.</p>
            <p>É nesta aba que serão gerados todos as ordens de serviço para as áreas de Projetos, Infraestrutura e Arquitetura (PIA) e Tecnologia da Informação (TI).</p>
        </div>
        <div class="col-md-12 mb-3">
            <h4 id="1.1.locais">1.1. Locais</h4>
            <img src="{{ asset('img/manual/locais.png') }}" alt="locais" class="img-fluid">
            <p class="text-justify">No sistema o museu foi dividido por andares e dentro dos andares houve a especificação do ambiente onde o problema está ocorrendo.</p>
            <p class="text-justtify">Como se pode notar na imagem, temos selecionado o 1º andar e no próximo campo há a lista de ambientes dentro do primeiro andar. </p>
        </div>
        <div class="col-md-12 mb-3">
            <h4 id="1.2.servicos">1.2. Serviços</h4>
            <img src="{{ asset('img/manual/servicos.png') }}" alt="servicos" class="img-fluid">
            <p class="text-justify">A parte de serviços está dividida da mesma forma que a seção “Local”. Portanto, o usuário escolherá a área que deseja o reparo (PIA ou TI), o setor desejado e o serviço.</p>
        </div>
        <div class="col-md-12 mb-3">
            <h4 id="1.2.1.recorrencia">1.2.1. Recorrência</h4>
            <img src="{{ asset('img/manual/recorrencia.png') }}" alt="recorrencia" class="img-fluid">
            <p class="text-justify">Esta funcionalidade está habilitada somente para os usuários que fazem parte das áreas de suporte (PIA/TI) e ela se refere a tarefas que são periódicas.</p>
            <p class="text-justify">Por esse motivo, o usuário somente poderá criar chamados recorrentes para a área de suporte que faz parte.</p>
            <p class="text-justify">Para criar um chamado recorrente, o usuário mudará o radio button para a posição ‘sim’ e automaticamente aparecerá na tela os seguintes campos: data prevista, quantidade de recorrências e tipo de recorrência.</p>
            <p class="text-justify">O campo data prevista se refere à data em que a primeira ordem de serviço deverá ser cumprida; o campo quantidade de recorrências se refere à quantidade de vezes que essa atividade deverá ser realizada, tendo como valor mínimo 2; e o campo tipo de recorrência indica se a recorrência será diária, semanal, mensal…</p>
            <p class="text-justify">Além da criação das ordens de serviço no sistema, esta funcionalidade cria um evento no Google Agenda, indexando ao evento todos os colaboradores que estão relacionados com a área de suporte automaticamente e disparando um alerta no computador do colaborador e no celular, caso o colaborador tenha logado com o e-mail da instituição no aparelho.</p>
        </div>
        <div class="col-md-12 mb-3">
            <h4 id="1.3.detalhes">1.3. Detalhes</h4>
            <img src="{{ asset('img/manual/detalhes.png') }}" alt="detalhes" class="img-fluid">
            <p class="text-justify">Na seção Detalhes o usuário detalhará o que de fato está acontecendo.</p>
            <p class="text-justify">Há três campos nesta seção: data desejada, anexo e descrição do problema.</p>
            <p class="text-justify">No campo data desejada o usuário poderá ou não informar uma data que ele precise que o serviço seja realizado.</p>
            <p class="text-justify">Este campo não obriga a área de suporte a realizar o reparo até a data informada, mas tem como finalidade orientá-los quando realizarem a lista de prioridades.</p>
            <p class="text-justify">No campo anexo o usuário terá a possibilidade de anexar qualquer arquivo que sirva para ilustrar o problema.</p>
            <p class="text-justify">E, por fim, no campo descrição do problema o usuário deverá descrever o que está acontecendo para a área de suporte.</p>
            <p class="text-justify">Ao se clicar em salvar, o sistema validará as informações fornecidas pelo usuário e, caso esteja tudo certo, salvará a ordem de serviço disparando um e-mail para a área de suporte responsável que conterá alguns detalhes e um link direto para o chamado.</p>
        </div>
        <div class="col-md-12 mb-3">
            <h4 id="2.lista_chamados">2. Lista de Chamados</h4>
            <img src="{{ asset('img/manual/lista_chamados.png') }}" alt="lista chamados" class="img-fluid">
            <p class="text-justify">Na aba ‘Chamados’ aparecerão todas as ordens de serviço que, de alguma forma, se referem ao usuário logado, organizados por status nesta ordem: aberto, andamento, concluído e recusado.</p>
        </div>
        <div class="col-md-12 mb-3">
            <h4 id="2.1.niveis">2.1. Níveis de Visualização</h4>
            <p class="text-justify">- <b>1º Nível</b>: no caso de usuários que não pertençam às áreas de suporte e não exerçam funções de gestão, serão apresentados somente os chamados que este usuário abriu;</p>
            <p class="text-justify">- <b>2º Nível</b>: os usuários de suporte verão, por padrão, os chamados referentes a sua área de atuação, tendo a possibilidade de ver os seus próprios chamados ao mudar o filtro ‘Tipo de Chamado’;</p>
            <p class="text-justify">- <b>3º Nível</b>: aos usuários que exerçam função de gestão em áreas diferentes das áreas de suporte, por padrão, serão apresentados os chamados dos colaboradores que fazem parte do seu departamento, sendo possível filtrar por área de suporte;</p>
            <p class="text-justify">- <b>4º Nível</b>: aos usuários que exerçam função de gestão nas áreas de suporte (PIA/TI), por padrão, serão apresentados os chamados de suporte de sua área e, assim como os usuários anteriores, há a possibilidade de ver os chamados dos seus colaboradores e seus próprios chamados;</p>
            <p class="text-justify">- <b>5º Nível</b>: aos usuários que exerçam função de diretoria, por padrão, serão apresentados os chamados de todos os colaboradores do museu, com a possibilidade de acessar os chamados que o próprio usuário tenha aberto.</p>
        </div>
        <div class="col-md-12 mb-3">
            <h4 id="2.2.filtros">2.2. Filtros</h4>
            <p class="text-justify">- <b>Itens por página</b>: dá a possibilidade de o usuário escolher a quantidade de itens a serem mostrados a página. Os valores possíveis são 10 (padrão), 20 e 50;</p>
            <p class="text-justify">- <b>Status</b>: filtra os chamados obedecendo o status selecionado. O padrão é mostrar todos os chamados organizados na ordem: aberto, andamento, concluído e recusado;</p>
            <p class="text-justify">- <b>Tipo de Chamado</b>: este filtro não estará visível para os usuários que pertençam ao 1º nível de usuários. Possibilita filtrar as ordens de serviço mostrando os chamados criados pelo próprio usuário, chamados abertos pelos seus colaboradores e os chamados de suporte;</p>
            <p class="text-justify">- <b>Data</b>: possibilita ao usuário buscar por OS’s que foram abertas em um determinado intervalo de datas. O padrão do sistema é buscar os chamados que foram abertos nos últimos 12 meses;</p>
            <p class="text-justify">- <b>Solicitante</b>: filtra as OS’s de acordo com o usuário que a abriu. Não está visível para o 1º nível de usuário;</p>
            <p class="text-justify">- <b>Departamento</b>: este filtro não está disponível para os usuários do 1º e do 2º nível. Filtra os chamados dos colaboradores subordinados por área de suporte;</p>
            <p class="text-justify">- <b>Busca</b>: filtro ‘coringa’ que realiza busca de chamados por fragmentos de texto. Os campos buscados são: código, solicitante, local, ambiente, setor e serviço.</p>
        </div>
        <div class="col-md-12 mb-3">
            <h4 id="2.3.visualizacao_rapida">2.3. Visualização Rápida</h4>
            <img src="{{ asset('img/manual/visualizacao_rapida.png') }}" alt="visualizacao rapida" class="img-fluid">
            <p class="text-justify">Clicando no botão com ícone de óculos, o sistema abre um ‘modal’ mostrando mais detalhes do chamado sem que o usuário precise carregar outra página.</p>
        </div>
        <div class="col-md-12 mb-3">
            <h4 id="2.4.pagina_gestao">2.4. Página de Gestão/Visualização Completa</h4>
            <p class="text-justify">Clicando no ícone <img src="{{ asset('img/manual/icone.png') }}" alt="icone"> o usuário será direcionado para a página de gestão/visualização completa da ordem de serviço.</p>
            <p class="text-justify">Além de mostrar todos os detalhes do chamado, esta tela permite que o usuário realize a gestão da ordem de serviço. </p>
            <img src="{{ asset('img/manual/pagina_gestao.png') }}" alt="visualizacao rapida" class="img-fluid">
        </div>
        <div class="col-md-12 mb-3">
            <h4 id="2.4.1.detalhes">2.4.1. Detalhes</h4>
            <div class="text-center">
                <img src="{{ asset('img/manual/detalhes2.png') }}" alt="detalhes" class="img-fluid">
            </div>
            <p class="text-justify">Mostra todos os detalhes da ordem de serviço.</p>
        </div>
        <div class="col-md-12 mb-3">
            <h4 id="2.4.2.descricao">2.4.2. Descrição</h4>
            <div class="text-center">
                <img src="{{ asset('img/manual/descricao.png') }}" alt="descricao" class="img-fluid">
            </div>
            <p class="text-justify">Este campo estará visível apenas para o usuário que abriu o chamado, possibilitando que ele faça uma atualização na descrição do problema.</p>
            <p class="text-justify">Outro detalhe importante é que este campo estará visível apenas enquanto a ordem de serviço estiver com status aberto.</p>
        </div>
        <div class="col-md-12 mb-3">
            <h4 id="2.4.3.mao_de_obra">2.4.3. Mão de Obra</h4>
            <div class="text-center">
                <img src="{{ asset('img/manual/mao_de_obra.png') }}" alt="mao de obra" class="img-fluid">
            </div>
            <p class="text-justify">A seção ‘Mão de Obra’ estará visível apenas para a equipe responsável por atender a ordem de serviço</p>
            <p class="text-justify">Quando estiver indicado como mão de obra própria, indica que a equipe do museu que realizará o reparo e quando estiver indicado como mão de obra terceirizada, indica que será necessária a contratação de uma equipe externa para concluir a solicitação.</p>
        </div>
        <div class="col-md-12 mb-3">
            <h4 id="2.4.4.observacoes">2.4.4. Observações</h4>
            <div class="text-center">
                <img src="{{ asset('img/manual/observacoes.png') }}" alt="observacoes" class="img-fluid">
            </div>
            <p class="text-justify">A seção ‘Observações’ tem como finalidade a comunicação entre a equipe que atenderá a OS e o solicitante. </p>
            <p class="text-justify">Neste campo a equipe responsável poderá adicionar informações adicionais sobre o andamento do processo, funcionando como canal direto entre a equipe de suporte e solicitante.</p>
            <p class="text-justify">Apenas a equipe de suporte terá a possibilidade de adicionar registros nesse campo.</p>
        </div>
        <div class="col-md-12 mb-3">
            <h4 id="2.4.5.status">2.4.5. Status</h4>
            <p class="text-justify">- <b>Aberto</b>: assim que o chamado é aberto pelo usuário, este será o status indexado a ele.</p>
            <div class="text-center">
                <img src="{{ asset('img/manual/status_aberto.png') }}" alt="status aberto" class="img-fluid">
            </div>
            <p class="text-justify mt-2">- <b>Andamento</b>: após o acolhimento da OS pela equipe responsável terá de informar escolher os colaboradores que atenderão, uma previsão de horas para a conclusão do trabalho e uma previsão de data. O botão com ícone de download abre um PDF para que a equipe possa imprimir a ordem de serviço e entregar à equipe de realizará o trabalho;</p>
            <div class="row d-flex justify-content-center align-items-center">
                <div class="col-md-6 mt-2">
                    <div class="text-center">
                        <img src="{{ asset('img/manual/status_andamento1.png') }}" alt="status andamento" class="img-fluid">
                    </div>
                </div>
                <div class="col-md-6 mt-2">
                    <div class="text-center">
                        <img src="{{ asset('img/manual/status_andamento2.png') }}" alt="status andamento" class="img-fluid">
                    </div>
                </div>
            </div>
            <p class="text-justify mt-2">- <b>Concluído</b>: para concluir uma OS, a equipe responsável deverá informar a quantidade de horas que realmente foram gastas e a data real de conclusão do serviço.</p>
            <div class="text-center">
                <img src="{{ asset('img/manual/status_concluido.png') }}" alt="status concluido" class="img-fluid">
            </div>
            <p class="text-justify mt-2">- <b>Recusado</b>: a equipe responsável poderá recusar uma OS quando assim entender em qualquer estágio da solicitação. Para tanto, será necessário justificar esta recusa.</p>
            <div class="text-center">
                <img src="{{ asset('img/manual/status_recusado.png') }}" alt="status recusado" class="img-fluid">
            </div>
        </div>
        <div class="col-md-12 mb-3">
            <h4 id="3.relatorios">3. Relatórios</h4>
            <div class="text-center">
                <img src="{{ asset('img/manual/relatorios.png') }}" alt="relatorios" class="img-fluid">
            </div>
            <p class="text-justify mt-2">A aba ‘Relatórios’ estará visível para todos os usuários exceto para os que pertençam ao 1º nível. Neste menu será possível gerar uma tabela Excel com os chamados que de alguma forma se relacionem com o usuário logado e obedecendo os parâmetros que podem ser definidos pelos filtros.</p>
        </div>
        <div class="col-md-12 mb-3">
            <h4 id="4.os_avulsa">4. OS Avulsa</h4>
            <div class="text-center">
                <img src="{{ asset('img/manual/avulsa.png') }}" alt="avulsa" class="img-fluid">
            </div>
            <p class="text-justify mt-2">Este menu tem como finalidade a documentação de OS’s que venham a ser abertas durante os finais de semana, onde não há expediente administrativo.</p>
            <p class="text-justify">Ele estará visível apenas para os usuários que pertençam as áreas de suporte e gera um PDF em branco para o preenchimento dos detalhes da OS, possibilitando o seu lançamento a posteriori.</p>
        </div>
        <div class="col-md-12 mb-3">
            <h4 id="5.suporte">5. Suporte</h4>
            <p class="text-justify mt-2">Qualquer problema que aconteça durante a utilização do software, tire um printscreen da tela de erro e entre em contato com o suporte pelo e-mail <a href="https://mail.google.com">ti@masp.org.br</a>.</p>
        </div>
    </div>
    @endsection
