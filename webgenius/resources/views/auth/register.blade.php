<x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
        </x-slot>

        <x-jet-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
            @csrf
            @method('POST')
            <div>
                <x-jet-label for="name" value="{{ __('Nome do Aluno') }}" />
                <x-jet-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            </div>

            <div class="mt-4">
                <x-jet-label for="email" value="{{ __('Email') }}" />
                <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required/>
            </div>

        
            <div class="mt-4">
                <x-jet-label for="telefone" value="{{ __('Telefone') }}" />
                <x-jet-input id="telefone" class="block mt-1 w-full" type="text" name="telefone" required autocomplete="new-password" />
            </div>

            <div class="mt-4">
                <x-jet-label for="Processo" value="{{ __('Nº de Processo') }}" />
                <x-jet-input id="Processo" class="block mt-1 w-full" type="number" name="num_processo" required autocomplete="new-password" />
            </div>

            <div class="mt-4">
                <label class="custom-control custom-radio">
                    <input id="radio1" name="genero_aluno" type="radio" required="required" value="Feminino">
                    <span class="custom-control-indicator"></span>
                    <span class="custom-control-description">Feminino</span>
                </label>

                <label class="custom-control custom-radio">
                    <input type="radio" name="genero_aluno" id="flexRadioDefault1"  required="required" value="Masculino">
                    <span class="custom-control-indicator"></span>
                    <span class="custom-control-description">Masculino</span>
                </label>
            </div>

            <div class="mt-4">
                <label for="datanasc_aluno">Data de Nascimento</label>
                <input type="date" name="data_nasc" class="form-control" id="datanasc_aluno" placeholder="data de nascimento"  required="required">
            </div>

            <div class="mt-4">
                <input type="file" name="image" class="form-control btn btn-light" accept="image/*" onchange="isImagem(this)"
                onchange="updatePreview(this, 'image-preview');"  required="required" title="Faça o upload de uma fotografia meio corpo" data-toggle="tooltip" data-placement="top" required="required">
                <img id="image-preview"
                        style="width:200px"
                        class="img-fluid img-thumbnail" alt="placeholder" >
            </div>

           <div class="mt-4">
            <select name="nome_turma" id="">
                <option value="" selected disabled>Turma</option>
                    @foreach($turmas as $turma)
                          <option value="{{$turma->nome_turma}}">{{$turma->nome_turma}}</option>
                    @endforeach
               </select>
               <select name="nome_classe" id="">
                <option value="" selected disabled>Classe</option>
                    @foreach($classes as $classe)
                          <option value="{{$classe->nome_classe}}">{{$classe->nome_classe}}</option>
                    @endforeach
               </select>
               <select name="nome_curso" id="">
                <option value="" selected disabled>Curso</option>
                    @foreach($cursos as $curso)
                          <option value="{{$curso->nome_curso}}">{{$curso->nome_curso}}</option>
                    @endforeach
               </select>
               
           </div>

           

            <div class="flex items-center justify-end mt-4">
               

                <x-jet-button class="ml-4">
                    {{ __('Cadastrar') }}
                </x-jet-button>
            </div>
        </form>

        <script>
            function isImagem(i){
              
              var img = i.value.split(".");
              var ext = "."+img.pop();
           
              if(!ext.match(/\.(gif|jpg|jpeg|tiff|png)$/i)){
                 alert("Não é imagem");
                 i.value = '';
                 return;
              }
           }
           
           </script>

    </x-jet-authentication-card>
</x-guest-layout>
