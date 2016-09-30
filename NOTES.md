# Fetching Data

## Setting up the database
 - SQLite looks for 'database/database.sqlite'

## Migrations
  Good for collaboration.
  Run only one command to execute all commands
### Creating a migration
`php artisan make:migration create_cards_table --create=cards`
It's a general convention to name your migration to describe what you're doing
### Migrating the migration
`php artisan migrate`
### PHP cli environment
If you need to try out or test some things
`php artisan tinker`
## Create new card
`DB::table('cards')->insert(['title' => 'My New Card', 'created_at' => new DateTime, 'updated_at' => new DateTime]);`
## Get all
`DB::table('cards')->get();`
## Get one record
`DB::table('cards')->where('title', 'My New Card')->first();`
## Delete any row with [title]
`DB::table('cards')->where('title', 'My New Card')->delete();`

## Eloquent
### Create a new model
`php artisan make:model Card`
Stored in 'app/'
### Make use of the model
Import the 'Card' model to the Controller class
`use App\Card;`
### Fetching data on 'tinker'
`App\Card:all();`
### Json return
When you return a record straight from your Controller and you don't load a view, Laravel automatically converts the output into JSON
### Route-Model-Binding
 - The Controller method needs to be Type Hinted
    `public function show(Card $match){...}`
 - The route uri wildcard needs to match the variable name in the parameter
     `Route::get('cards/{match}', 'CardsController@show');`


# Defining Relationships with Eloquent

### Create a new migration with table 'notes'
`php artisan make:migration create_notes_table --create=notes`
`php artisan migrate`

### Create note model
`php artisan make:model Note`
OR create model AND migration at the same time
`php artisan make:model Note -m`

### Get the first card
`$card = App\Card::first();`

### Create a new note, insert data, assign it to a card MANUALLY
`$note = new App\Note`
`$note->body = 'Some note for the card.';`
`$note->card_id = 2;`
`$note->save();`

## Eloquent way:
Create a `notes` function in the `Card` model
A Card has many Notes:
`public function notes() { return $this->hasMany(Note::class); }`
### Get only the notes associated with the first card
`$card = App\Card::first();`
`$card->notes;` OR `$card->notes[0];` OR
`$card->notes->first();` => Fetch a collection of ALL notes, return collection and fetch the first note of that collection
WHICH IS DIFFERENT FROM THIS
`$card->notes()->first();` => Fetch only a SINGLE record from the database

### When querying the database for `$card->notes;`, Laravel caches all notes into the card object for subsequent use

### Now the other way around: From a note, fetch the card
Create a `card` function in the `Note` model
`public function card() { return $this->belongsTo(Card::class); }`
`$note = App\Note::first();`
`$note->card;`

### After assigning the relationships in the Model classes, Eloquent makes it easier to create and assign relationships
`$note = new App\Note;`
`$note->body = 'Here is another note.';`
`$card = App\Card::first();`
Instead of setting the card_id manually like `$note->card_id = x;`, you can let Eloquent handle that:
`$card->notes()->save($note);`
Or instead of creating a new note each time
`$card->notes()->create(['body' => 'Yet another note about this card.']);`
BUT to do the above you need to explicitly tell the model to allow it
`Note.php
class Note extends Model {
    protected $fillable = ['body'];
}`

# Updating Records and Eager Loading

### PATCH request Work-around
Some browsers dont understand some REST principles (PATCH, DELETE), so we need to implement a work around.
The form needs to be as follows:
`<form method='POST>
    {{ method_field('PATCH') }}
    ||
    {{ method_field('DELETE') }}
</form>'`
When we submit the form, Laravel is going to check if the form has anything with the name 'PATCH', and, if so, that means the user wants a special request type. And since we want a 'PATCH' request, Laravel looks for one in our routes.

### Creating the user, note and card
`php artisan tinker`
`namespace App;
$card = new Card;
$card->title = 'My First Card';
$card->save();
$note = new Note;
$note->user_id = 1;
$note->body = 'The body of the note.';
$card->addNote($note);
$user = new User;
$user->username = 'Username';
$user->email = 'email@email.com';
$user->password = bcrypt('password');
$user->save();`

# Validation and More
## Forms
Always include `{{ csrf_field() }}` into your forms.
## Validation
`$this->validate($request, [
    'body' => 'required|unique'
    'email' => ['email', 'unique:users']
]);`


# Authenticate Users
This is generally done at the beginning of a project, rather than later. So start with a new project
`laravel new some-project
php artisan make:auth
touch database/database.sqlite`
Don't forget to change the database connection to 'sqlite' in `database.php`
`php artisan migrate`
And it's done!
## Included features
 - Registration
 - Login
 - Logout
 - Authentication (only logged user can access /home)
 - Password reset

Remember: You need to enable email configurations for password resets

File: `.env`
The default mail driver is `MAIL_DRIVER=smtp` (production)
When locally, change to `MAIL_DRIVER=log`. Logs are located at `storage/logs`

File: `config/mail.php`
Specify the FROM address
`'from' => ['address' => 'some@email.com', 'name' => 'Some Name'],`
