<x-layouts.base title="Личный кабинет">
    <div class="alert alert-success w-50">
        <b>{{ $user->name }}</b> <em>{{ $user->email }}</em>
    </div>
    <div class="form-control p-2">
        <x-form enctype="multipart/form-data" method='put' action="{{ route('profile.update') }}">
            @bind($user)
                <div class="mb-2 w-50">
                    <x-form-input name="name" label="Имя пользователя"/>
                </div>
                <img class="img-thumbnail avatar" src="{{ asset('storage/img/users') }}/{{ $user->picture }}">
                <div class="mb-2 w-50">
                    <x-form-input type="file" name="picture" label="Изменить аватар"/>
                </div>
                <div class="mb-2 w-50">
                    <button class="btn btn-primary">Принять изменения</button>
                </div>
                <div class="mb-2 w-50">
                    <a href="{{ route('password.edit') }}"><button type="button" class="btn btn-success">Сменить пароль</button></a>
                </div> 
            @endbind
        </x-form>
        Зарегистрирован<em> {{ $user->created_at }}</em>
    </div>
</x-layouts.base>