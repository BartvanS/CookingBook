@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
@csrf
<br>
<label for="title">Titel</label><input type="text" name="title" value="{{$fields->title}}"><br><br>
<label for="description">Beschrijving</label><textarea name="description">{{$fields->description}}</textarea><br><br>
<label for="hours">Tijd in uren</label><input type="number" name="hours" value="{{$fields->hours}}"><br><br>
<label for="minutes">Tijd in minuten</label><input type="number" name="minutes" value="{{$fields->minutes}}"><br><br>
<label for="ingredients">Ingredienten</label><textarea type="text" name="ingredients">{{$fields->ingredients}}</textarea><br><br>

<input type="submit">
