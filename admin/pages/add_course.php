<h1>Neue Klasse anlegen</h1>
<div>
    <form method="post" action="../../backend/validation/validate_add_course.php">
        <div>    
            <label for="course_name">Name der Klasse</label>
            <input id="course_name" name="course_name"><br>
        
            <p>Metainformationen zur Klasse</p>
        </div>
        <div>
            <label for="course_profession">Beruf der Klasse</label>
            <input id="course_profession" name="course_profession">
        </div>

        <div>
            <label for="course_section">Blockwoche</label>
            <input id="course_section" name="course_section">
        </div>

        <div>
            <label for="course_year">Jahrgangsstufe der Klasse</label>
            <input id="course_year" name="course_year">
        </div>

        <div>
            <label for="course_school_year">Schuljahr</label>
            <input id="course_school_year" name="course_school_year">
        </div>
    
        <input type="submit" value="Speichern">
    </form>
</div>
