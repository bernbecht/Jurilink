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
                <h1>Editar Processo<button id="ativa_video_help_btn" class="btn btn-info pull-right voltarTextoHelpBtn"><i class="icon-play-circle icon-white"></i> Vídeo</button></h1>
            </div>
            <p>
                Nesta tela é possível <span class="label label-info">editar</span> um  <span class="label label-info">Processo</span>
                no sistema.
            </p>
            <div class="page-header">
                <h1>Campos do Formulário </h1>
            </div>
            <p>
                Para editar um processo é necessário preencher pelo menos os campos obrigatórios indicicados pela cor
                amarela.

            <h3>Descrição dos Campos do Formulário</h3>
            </p>
            <dl class="" >
                <dt>Número Unificado</dt>
                <dd>Campo obrigatório. Deve possuir 21 números.</dd>
                
                <dt>Data de Distribuição</dt>
                <dd>Campo obrigatório. A data deve ser no formato DD/MM/AAAA</dd>
                
                <dt>Juízo</dt>
                <dd>Campo obrigatório.</dd>
                
                <dt>Natureza da Ação</dt>
                <dd>Campo obrigatório.</dd>
                
                <dt>Valor da Causa</dt>
                <dd>Campo obrigatório. O valor deve ter vírgula. Ex: 1200,00</dd>
                
                <dt>Autor</dt>
                <dd>Campo obrigatório. Este campo é <span class="label label-info">Autocomplete</span>. Basta começar a digitar o <span class="label label-info">nome</span>, <span class="label label-info">CPF</span> ou 
                    <span class="label label-info">RG</span> da 
                    pessoa desejada para que uma barra com a relação das possíveis pessoas cadastradas no sistema apareça abaixo do campo. Caso a pessoa não exista, esta relação
                    não irá aparecer. Para <span class="label label-info">adicionar</span> esta pessoa não existente, basta clicar no botão <i class="icon-plus"></i>
                ao lado do campo. Um formulário de cadastro aparecerá sem a necessidade de sair da página. Para incluir <span class="label label-info">múltiplos autores</span>, coloque uma vírgula e digitar o nome
                do próximo autor.</dd>
                
                <dt>Advogado do Autor</dt>
                <dd>Campo obrigatório. Este campo é <span class="label label-info">Autocomplete</span>. Basta começar a digitar o <span class="label label-info">nome</span>, <span class="label label-info">CPF</span>, 
                    <span class ="label label-info">RG</span> ou <span class ="label label-info">OAB</span> do 
                    advogado desejado para que uma barra com a relação das possíveis pessoas cadastradas no sistema apareça abaixo do campo. Caso a pessoa não exista, esta relação
                    não irá aparecer. Para <span class="label label-info">adicionar</span> esta pessoa não existente, basta clicar no botão <i class="icon-plus"></i>
                ao lado do campo. Um formulário de cadastro aparecerá sem a necessidade de sair da página. Para incluir <span class="label label-info">múltiplos advogados</span>, coloque uma vírgula e digitar o nome
                do próximo advogado.</dd>
                
                <dt>Representante do Autor</dt>
                <dd>Campo opcional. Este campo é <span class="label label-info">Autocomplete</span>. Basta começar a digitar o <span class="label label-info">nome</span>, 
                    <span class="label label-info">CPF</span> ou
                    <span class ="label label-info">RG</span> do 
                    representante desejado para que uma barra com a relação das possíveis pessoas cadastradas no sistema apareça abaixo do campo. Caso a pessoa não exista, esta relação
                    não irá aparecer. Para <span class="label label-info">adicionar</span> esta pessoa não existente, basta clicar no botão <i class="icon-plus"></i>
                ao lado do campo. Um formulário de cadastro aparecerá sem a necessidade de sair da página. Para incluir <span class="label label-info">múltiplos representantes</span>, coloque uma vírgula e digitar o nome
                do próximo representante.</dd>
                
                <dt>Réu</dt>
                <dd>Campo obrigatório. Este campo é <span class="label label-info">Autocomplete</span>. Basta começar a digitar o <span class="label label-info">nome</span>, <span class="label label-info">CPF</span> ou 
                    <span class="label label-info">RG</span> da 
                    pessoa desejada para que uma barra com a relação das possíveis pessoas cadastradas no sistema apareça abaixo do campo. Caso a pessoa não exista, esta relação
                    não irá aparecer. Para <span class="label label-info">adicionar</span> esta pessoa não existente, basta clicar no botão <i class="icon-plus"></i>
                ao lado do campo. Um formulário de cadastro aparecerá sem a necessidade de sair da página. Para incluir <span class="label label-info">múltiplos réus</span>, coloque uma vírgula e digitar o nome
                do próximo autor.</dd>
                
                <dt>Advogado do Réu</dt>
                <dd>Campo obrigatório. Este campo é <span class="label label-info">Autocomplete</span>. Basta começar a digitar o <span class="label label-info">nome</span>, <span class="label label-info">CPF</span>, 
                    <span class ="label label-info">RG</span> ou <span class ="label label-info">OAB</span> do 
                    advogado desejado para que uma barra com a relação das possíveis pessoas cadastradas no sistema apareça abaixo do campo. Caso a pessoa não exista, esta relação
                    não irá aparecer. Para <span class="label label-info">adicionar</span> esta pessoa não existente, basta clicar no botão <i class="icon-plus"></i>
                ao lado do campo. Um formulário de cadastro aparecerá sem a necessidade de sair da página. Para incluir <span class="label label-info">múltiplos advogados</span>, coloque uma vírgula e digitar o nome
                do próximo advogado.</dd>
                
                <dt>Representante do Réu</dt>
                <dd>Campo opcional. Este campo é <span class="label label-info">Autocomplete</span>. Basta começar a digitar o <span class="label label-info">nome</span>, 
                    <span class="label label-info">CPF</span> ou
                    <span class ="label label-info">RG</span> do 
                    representante desejado para que uma barra com a relação das possíveis pessoas cadastradas no sistema apareça abaixo do campo. Caso a pessoa não exista, esta relação
                    não irá aparecer. Para <span class="label label-info">adicionar</span> esta pessoa não existente, basta clicar no botão <i class="icon-plus"></i>
                ao lado do campo. Um formulário de cadastro aparecerá sem a necessidade de sair da página. Para incluir <span class="label label-info">múltiplos representantes</span>, coloque uma vírgula e digitar o nome
                do próximo representante.</dd>
                
                <dt>Trânsito em Julgado</dt>
                <dd>Campo opcional. A data deve ser no formato DD/MM/AAAA e não deve ser mais antiga que a <span class="label label-info">Data de Expedição</span>.</dd>
                
                <dt>Depósito Judicial</dt>
                <dd>Campo opcional. O valor deve ter vírgula. Ex: 1200,00</dd>
                
                <dt>Auto da Penhora</dt>
                <dd>Campo opcional. O valor deve ter vírgula. Ex: 1200,00</dd>    

            </dl>
            <h3>Botões do Formulário</h3>
            <dl>
                <dt>Salvar</dt>
                <dd>Adiciona o processo ao sistema e retorna à tela com os dados do processo.</dd>              
                <dt>Cancelar</dt>
                <dd>Cancela a operação e retorna à tela com a retorna retorna à tela com os dados do processo.</dd>            
            </dl>
        </div>
    </div>
</div>