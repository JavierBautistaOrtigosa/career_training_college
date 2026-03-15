### Project Introduction

**Career Training College**
_Event & Member Management System_

The system allows authenticated users to view members and events, while admin users can create, edit, and delete records. The project includes table and card views, filtering, sorting and pagination.

### Project Purpose

The main purpose of this project was to design and build a fully functional dynamic website that demonstrates:

- Server-side scripting.
- Client-side components.
- A structured database.
- CRUD operations.
- MVC architecture.
- Professional UI design.
- Web development frameworks.

### Technologies Used

- **Backend & Framework:**
  Laravel (PHP Framework)
  Routing
  Controllers
  Models
  Migrations
  Validation
  MVC structure

- **Frontend:**
  Blade Templates
  Reusable layouts
  Dynamic content rendering
  Bootstrap 5
  Responsive design
  Layout
  Spacing
  UI Components
  Custom CSS
  Fine tune styling and advanced layout control

- **Database:**
  MySQL
  Used to store:
  Members
  Events
  User authentication data.

### UI & Design Decisions

- **Key Design Features:**
  Bootstrap grid system for layout.
  Flexbox for alignment and spacing.
  Consistent typography and spacing rhythm.
  Reusable header and button components.
  Card view layout for visual presentation.
  Table view layout for structured data.

### Database Structure

- **The database consists of three main tables:**
  Users - Used for authentication.
  Members - Stores members information.
  Events - Stores event information.

- All tables we created using Laravel migrations, ensuring the structure is version‑controlled and reproducible.

### CRUD

- Essentially, CRUD operations are handled through Laravel controllers and models, ensuring clean separation of logic. Both the **Members** and **Events** modules support full CRUD operations.

- **Create**
  Used to add new Members or Events into the system. Admin users access a form, submit validated data, and Laravel stores the new record in the database.

- **Read**
  Displays existing records to the user. Both Members and Events can be viewed in table or card layouts, with support for search, filtering, sorting, and pagination.

- **Update**
  Allows admin users to edit existing records. Laravel loads the current data into an edit form, validates the changes, and updates the database.

- **Delete**
  Admin users can remove Members or Events from the system.

### Authentication without middleware

This project intentionally avoids Laravel’s built‑in authentication middleware to match the class‑demo approach taught in class. Instead of using `auth` middleware or guards, the application uses a **manual session‑based login system**.

Every protected controller method begins with a check like:

```php
if (!session('isLoggedIn')) {
    return redirect('/login');
}
```

**This ensures:**

- Only logged‑in users can access Members and Events pages
- Admin‑only actions (Create, Edit, Delete) are protected using an additional role check
- No Laravel middleware, guards, or policies are used
- The authentication flow remains simple and fully aligned with the class demonstration

This manual approach keeps the logic easy to follow and makes the authentication process transparent for learning purposes.

### READ - Members List (index method description)

- **User Action**:
  The user navigates to the Members page. The browser sends: `GET /members`
- **Lifecycle**
    1. Route matches.
    2. Manual authentication check. Every protected controller method begins with this check.
    3. Controller fetches all members using Eloquent ORM.
    4. Controller returns the Blade view, passing the members collection.
    5. Blade loops through the members and renders the table rows dynamically.

```php
// 1. Route matches.
Route::get('/members', [MembersController::class, 'index']);
```

```php
// 2. Manual authentication check.
if (!session('isLoggedIn')) {
    return redirect('/login');
}
```

```php
// 3. Fetch all members using Eloquent ORM.
$members = Member::all();
```

```php
// 4. Return Blade view with data.
return view('members.index', ['members' => $members]);
```

```php
// 5. Blade loops through the $members collection.
// (Inside members/index.blade.php)
@foreach ($members as $member)
    <tr>
        <td>{{ $member->first_name }}</td>
        <td>{{ $member->last_name }}</td>
        <td>{{ $member->email }}</td>
        <!-- etc... -->
    </tr>
@endforeach
```

### CREATE - Store New Member (store method description)

- **User Action**:
  The user fills out the add new member form.
  The user clicks on "Save Member": `POST /members`
- **Lifecycle**
    1.  Route matches.
    2.  Manual authentication check. Every protected controller method begins with.
    3.  Laravel validation runs. If any required field are missing or invalid, Laravel automatically redirects back with error messages.
    4.  If validation passes a new Member record is created using Eloquent.
    5.  Redirect After successful creation, the user is redirected back to the Members list.
        A new member is inserted into the database and immediately appears in the Members list.

```php
// 1. Route matches.
 `Route::post('/members', [MembersController::class, 'store']);`
```

```php
// 2. Manual authentication check.
if (!session('isLoggedIn')) {
	return redirect('/login');
}
```

```php
// 3. Laravel validation runs.
$request->validate([
	'first_name' => 'required',
	'last_name' => 'required',
	'age' => 'required|integer',
	'email' => 'required|email',
	'phone' => 'required',
	'address' => 'required'
]);
```

```php
// 4. Member record is created using Eloquent.
Member::create([
		'first_name' => $request->first_name,
		'last_name' => $request->last_name,
		'age' => $request->age,
		'email' => $request->email,
		'phone' => $request->phone,
		'address' => $request->address
]);
```

```php
//  5. Redirect after successful creation.
	return redirect()->route('members.index');
```

### How Models Interact With the Database Using Eloquent ORM

Eloquent ORM allows the application to interact with the database using clean, expressive PHP instead of raw SQL. Each model represents a database table, and Eloquent automatically converts model methods into SQL queries behind the scenes.

For example:

- `Member::all()` becomes a `SELECT` query
- `Member::create()` becomes an `INSERT` query
- `$member->update()` becomes an `UPDATE` query
- `$member->delete()` becomes a `DELETE` query

This keeps the code readable, secure, and consistent with Laravel best practices.

```php
// How Models Interact With the Database Using Eloquent ORM

Member::all();            // → SELECT * FROM members
Member::create([...]);    // → INSERT INTO members (...)
$member->update([...]);   // → UPDATE members SET ...
$member->delete();        // → DELETE FROM members WHERE id = ...
```

### MVC Architecture

The project follows the MVC (Model–View–Controller) architectural pattern. This structure keeps the application organized, scalable, and easy to maintain by separating responsibilities clearly.

- Models:
  `Member`
  `Event`
  `User`

Each model represents a database table and interacts with the database through **Eloquent ORM**. Eloquent automatically converts model methods into SQL queries, allowing the application to work with clean, readable PHP instead of raw SQL.

- Views (handle **presentation only**, with no business logic):
  Blade templates for all pages
  Shared layout file for consistent UI structure
  Table and Card views for displaying Members and Events
  Forms for Create and Edit operations
  Fully responsive using Bootstrap 5

- Controllers (handle the application logic, including):
  CRUD operations for Members and Events
  Manual authentication checks (class‑demo style)
  Form validation using Laravel’s built‑in validator
  Passing data to Blade views

- Routes
  All routes are defined in `routes/web.php`
  Each route maps a URL to a specific controller action
- Example:
  `Route::get('/members', [MembersController::class, 'index']);`
- Routes act as the entry point for all user requests, directing them to the correct controller method
