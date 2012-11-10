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
                <h1>Descrição do Processo<button id="ativa_video_help_btn" class="btn btn-info pull-right voltarTextoHelpBtn"><i class="icon-play-circle icon-white"></i> Vídeo</button></h1>
            </div>
            <p>
                Nesta tela é possível visualizar os dados detalhados de um <span class="label label-info">processo</span>
                do sistema.
            </p>

            <div class="page-header">
                <h1>Atos do Processo</h1>
            </div>
            <p>
                Esta seção informa as <span class="label label-info">3 últimas movimentações de ato</span> do processo.
                <br />
                Para <span class="label label-info">adicionar</span> um novo ato, clique no botão verde <span class="label label-info">+ Incluir Ato</span>. Uma notificação 
                será mandada automaticamente para o e-mail dos clientes deste processo se os atos forem pertinentes. O cadastro de novos atos pode ser feito na guia
                <span class="label label-info">Gerenciar Dados > Ato</span>.
                <br />
                Para <span class="label label-info">excluir</span> um ato clique no botão <i class="icon-remove-circle"></i> ao lado do ato.
                <br />
                O botão <span class="label label-info">Ver todos os atos</span> carrega na tela a relação com todos os atos deste processo.
            </p> 

            <div class="page-header">
                <h1>Audiências</h1>
            </div>            
            <p>
                Esta seção informa as <span class="label label-info">5 próximas audiências</span> do processo.
                <br />
                Para <span class="label label-info">adicionar</span> uma nova audiência, clique no botão verde <span class="label label-info">+ Incluir Audiência</span>.
                <br />
                Para <span class="label label-info">excluir</span> uma audiência clique no botão <i class="icon-remove-circle"></i> ao lado da audiência.
                <br />
                O botão <span class="label label-info">Ver todos as audiências</span> carrega na tela a relação com todos os audiências deste processo.
            </p> 



            <div class="page-header">
                <h1>Botões da Página</h1>
            </div>
            <dl class="dl-horizontal">
                <dt>Voltar</dt>
                <dd>Volta para página com a relação dos processos cadastrados no sistema</dd>
                <dt>Editar</dt>
                <dd>Carrega a tela para editar algum dado deste processo.</dd>
            </dl>

        </div>
    </div>
</div>