CREATE PROCEDURE Recalc_GPA

    @firstname varchar(30)
    @lastname varchar(30)
    @grade DECIMAL(3, 2)

AS
    SELECT @oldGPA = GPA from [Students]
    WHERE firstname=f_name AND lastname = l_name;

    SELECT @numClasses = #_classes_taken+1 from [Students]
    WHERE firstname=f_name AND lastname = l_name;

    SELECT @newGPA =((@oldGPA*(@numClasses-1)) +  grade)/ @numClasses;

    SELECT CAST(@newGPA AS DECIMAL(3, 2));

    UPDATE Students
    SET GPA = @newGPA, #_classes_taken= @numClasses
    WHERE firstname=f_name AND lastname = l_name;
