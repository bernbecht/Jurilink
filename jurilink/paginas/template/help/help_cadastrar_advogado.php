<!-- MODAL para Ajuda RELACAO PESSOA JURIDICA-->
<div id="helpModal" class="modal hide">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">x</button>
        <h3>Ajuda</h3>
    </div>
    <div class="modal-body">

        <div id='helpVideo'>
            <iframe width="513" height="315" src="http://www.youtube.com/embed/ZXgkhxJtONs" frameborder="0" allowfullscreen></iframe>
            <p class='centro'>
                <button style="margin-top: 10px;" id="voltaHelpEscritoBtn" class="btn btn-info">Voltar ao texto anterior</button>
            </p>
        </div>

        <div id="content_help">
            <div class="page-header">
                <h1>Cadastrar Advogado<button id="ativa_video_help_btn" class="btn btn-info pull-right voltarTextoHelpBtn"><i class="icon-play-circle icon-white"></i> Vídeo</button></h1>
            </div>
            <p>
                Nesta tela é possível cadastrar um ou mais <span class="label label-info">advogado</span>
                no sistema.
            </p>
            <div class="page-header">
                <h1>Campos do Formulário </h1>
            </div>
            <p>
                Para cadastrar um advogado é necessário preencher pelo menos os campos obrigatórios indicicados pela cor
                amarela.

            <h3>Descrição dos Campos do Formulário</h3>
            </p>
            <dl class="" >
                <dt>Nome</dt>
                <dd>Campo obrigatório. Deve possuir pelo menos 3 caracteres alfanúmericos.</dd>
                <dt>CPF</dt>
                <dd>Campo obrigatório. Deve conter apenas números. Não é permitido duas pessoas com o mesmo CPF no sistema.</dd>
                <dt>RG</dt>
                <dd>Campo obrigatório. Deve conter apenas números. Não é permitido duas pessoa com o mesmo RG no sistema.</dd>
                <dt>Órgão Expedidor</dt>
                <dd>Campo obrigatório. Órgão expedidor do RG. Deve possuir pelo menos 2 caracteres alfanúmericos.</dd>
                <dt>OAB</dt>
                <dd>Campo obrigatório. Deve conter pelo menos 3 números.</dd>
                <dt>Cidade</dt>
                <dd>Campo obrigatório. Deve possuir pelo menos 3 caracteres alfanúmericos.</dd>
                <dt>Estado</dt>
                <dd>Campo obrigatório.</dd>
                <dt>Endereço</dt>
                <dd>Campo opcional. Se digitado, deve possuir pelo menos 3 caracteres alfanúmericos.</dd>
                <dt>Bairro</dt>
                <dd>Campo opcional. Se digitado, deve possuir pelo menos 3 caracteres alfanúmericos.</dd>
                <dt>Telefone</dt>
                <dd>Campo opcional. Se digitado, deve ser informado apenas números com ou sem DDD.</dd>
                <dt>E-mail</dt>
                <dd>Campo opcional se a pessoa não for cliente e obrigatório se for cliente. Quando informado, 
                    deve possuir pelo menos 7 dígitos.</dd>
                <dt>User</dt>
                <dd>Campo opcional. Quando selecionado, o advogado será interpretado como um funcionário da advocacia e terá
                    acesso ao sistema. Uma senha é gerada pelo sistema e mandada automaticamente no e-mail
                    cadastrado. Desta forma é necessário informar um e-mail válido para esta pessoa. 
                    <br/>
                    A senha poderá
                    ser alterada pelo advogado na opção <span class="label label-info">Conta</span> no menu localizado 
                    no canto superior direito da tela junto ao e-mail logado.
                    <br/>
                    O e-mail informado deve ser único de forma que não exista duas pessoas com o mesmo e-mail cadastrado no
                    sistema.
                </dd> 

            </dl>
            <h3>Botões do Formulário</h3>
            <dl>
                <dt>Salvar</dt>
                <dd>Adiciona a pessoa ao sistema e retorna à tela com a relação de advogados cadastradas no
                    sistema.</dd>
                <dt>Salvar e Adicionar Outro</dt>
                <dd>Adiciona a pessoa ao sistema e limpa o formulário para que se possa adicionar outra pessoa.</dd>
                <dt>Cancelar</dt>
                <dd>Cancela a operação e retorna à tela com a relação de advogados cadastradas no sistema.</dd>            
            </dl>
        </div>
    </div>
</div>