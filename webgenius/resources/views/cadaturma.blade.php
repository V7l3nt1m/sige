
<div class="col-xxl-4 col-md-6">
    <div class="card card2">

      <div class="card-body">
        <h4 class="titulo">Gestão de Turmas</h4>
        <div class="container text-center">
          <div class="row">
            <div class="col">
              
          
            </div>
            <div class="col">
                
        
          
        </div>


        <div class="collapse" id="cadastrodeturmas">
          <form action="/pcaadmin/turmas" method="POST">
              @csrf
              @method('POST')
              <div class="row">
                  <div class="col-md-4">
                    <label for="nome_turma">Nome ou ID da turma</label>
                    <input type="text" class="form-control" id="nome_turma" placeholder="Nome ou ID da turma" name="nome_turma" required="required">
                  </div>
                 
                    <div class="col-md-4">
                      <label for="curso_turma">Associar a um curso</label>
                      <select name="curso_turma" id="curso_turma" class="form-control">
                        <option selected value="" disabled>Curso</option>
                        <option value="">curso1</option>
                      </select>
                        </div>
                        <div class="col-md-4">
                            <label for="classe_turma">Associar a uma classe</label>
                            <select name="classe_turma" id="classe_turma" class="form-control">
                              <option selected value="" disabled>Classe</option>
                              <option value="">classe1</option>
                            </select>
                              </div>
                              <label>Quantidade de alunos <input type="number" name="quantidade_alunos"></label>
              </div>
              <br>
              
              
              <input type="submit" value="Cadastrar" class="btn btn-primary">

            
            </form>
        </div>
      </div>

     

    </div>
  </div><!-- End Sales Card -->

