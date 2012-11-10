<!-- MODAL para Ajuda RELACAO PESSOA JURIDICA-->
<div id="helpModal" class="modal hide">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">x</button>
        <h3>Ajuda</h3>
    </div>
    <div class="modal-body">

        <div id='helpVideo'>
            <iframe width="513" height="315" src="http://www.youtube.com/embed/m1TnzCiUSI0" frameborder="0" allowfullscreen></iframe>
            <p class='centro'>
                <button style="margin-top: 10px;" id="voltaHelpEscritoBtn" class="btn btn-info">Voltar ao texto anterior</button>
            </p>
        </div>

        <div id="content_help">
            <div class="page-header">
                <h1>Visualização de Dados<button id="ativa_video_help_btn" class="btn btn-info pull-right voltarTextoHelpBtn"><i class="icon-play-circle icon-white"></i> Vídeo</button></h1>
            </div>
            <p>
                Nesta tela é possível visualizar os dados cadastrais de uma <span class="label label-info">pessoa</span>
                do sistema, os seus processos como <span class="label label-info">cliente</span> e 
                <span class="label label-info">contra</span> algum cliente da advocacia.
            </p>

            <div class="page-header">
                <h1>Processos com a Advocacia </h1>
            </div>
            <p>
                Esta seção informa os <span class="label label-info">3 processos mais recentes</span> em que esta pessoa é um <span class="label label-info">cliente</span> da advocacia ou parte de uma ação de um cliente.
                <br />
                É possível visualizar os dados do processo clicando no seu  <span class="label label-info">Número Unificado</span> que aparece com cor azul. 
                <br />
                Para visualizar todos o processos, basta clicar no botão <span class="label label-info">Ver todos os processos</span>.            
            </p>   

            <div class="page-header">
                <h1>Processos Contra a Advocacia </h1>
            </div>
            <p>
                Esta seção informa os <span class="label label-info">3 processos mais recentes</span> em que esta pessoa aparece como parte de uma ação contra um <span class="label label-info">cliente</span> da advocacia.
                <br />
                É possível visualizar os dados do processo clicando no seu  <span class="label label-info">Número Unificado</span> que aparece com cor azul. 
                <br />
                Para visualizar todos o processos, basta clicar no botão <span class="label label-info">Ver todos os processos</span>.            
            </p>

            <div class="page-header">
                <h1>Botões da Página</h1>
            </div>
            <dl class="dl-horizontal">
                <dt>Voltar</dt>
                <dd>Volta para página com a relação das pessoas cadastradas no sistema</dd>
                <dt>Editar</dt>
                <dd>Carrega a tela para editar algum dado cadastral desta pessoa</dd>
            </dl>

        </div>
    </div>
</div>