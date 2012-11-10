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
                <h1>Cadastrar Ato<button id="ativa_video_help_btn" class="btn btn-info pull-right voltarTextoHelpBtn"><i class="icon-play-circle icon-white"></i> Vídeo</button></h1>
            </div>
            <p>
                Nesta tela é possível cadastrar um ou mais <span class="label label-info">atos</span>
                no sistema.
            </p>
            <div class="page-header">
                <h1>Campos do Formulário </h1>
            </div>
            <p>
                Para cadastrar um novo pessoa ato é necessário preencher pelo menos os campos obrigatórios indicicados pela cor
                amarela.

            <h3>Descrição dos Campos do Formulário</h3>
            </p>
            <dl class="" >               
                <dt>Nome</dt>
                <dd>Campo obrigatório. Deve conter pelo menos 2 caracteres alfanuméricos.</dd>
                <dt>Previsão</dt>
                <dd>Campo obrigatório. Qual a previsão, em dias, para a mudança deste ato.</dd>
                <dt>Descrição</dt>
                <dd>Campo obrigatório. Descrição do ato. Mínimo de 2 caracteres.</dd>
                <dt>User</dt>
                <dd>Campo obrigatório. Indica se o(s) cliente(s) devem ser notificados quando este ato entrar em vigor.</dd>               
               

            </dl>
            <h3>Botões do Formulário</h3>
            <dl>
                <dt>Salvar</dt>
                <dd>Adiciona a pessoa ao sistema e retorna à tela com a relação dos cadastrados no
                    sistema.</dd>                
                <dt>Cancelar</dt>
                <dd>Cancela a operação e retorna à tela com a relação dos cadastrados no
                    sistema.</dd>            
            </dl>
        </div>
    </div>
</div>