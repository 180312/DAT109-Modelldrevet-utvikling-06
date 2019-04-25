//%% NEW FILE Professor BEGINS HERE %%

/*PLEASE DO NOT EDIT THIS CODE*/
/*This code was generated using the UMPLE 1.29.1.4448.81a70243a modeling language!*/



// line 2 "model.ump"
// line 28 "model.ump"
public class Professor
{

  //------------------------
  // MEMBER VARIABLES
  //------------------------

  //Professor Associations
  private Jury jury;

  //------------------------
  // CONSTRUCTOR
  //------------------------

  public Professor(Jury aJury)
  {
    boolean didAddJury = setJury(aJury);
    if (!didAddJury)
    {
      throw new RuntimeException("Unable to create professor due to jury");
    }
  }

  //------------------------
  // INTERFACE
  //------------------------
  /* Code from template association_GetOne */
  public Jury getJury()
  {
    return jury;
  }
  /* Code from template association_SetOneToMandatoryMany */
  public boolean setJury(Jury aJury)
  {
    boolean wasSet = false;
    //Must provide jury to professor
    if (aJury == null)
    {
      return wasSet;
    }

    if (jury != null && jury.numberOfProfessors() <= Jury.minimumNumberOfProfessors())
    {
      return wasSet;
    }

    Jury existingJury = jury;
    jury = aJury;
    if (existingJury != null && !existingJury.equals(aJury))
    {
      boolean didRemove = existingJury.removeProfessor(this);
      if (!didRemove)
      {
        jury = existingJury;
        return wasSet;
      }
    }
    jury.addProfessor(this);
    wasSet = true;
    return wasSet;
  }

  public void delete()
  {
    Jury placeholderJury = jury;
    this.jury = null;
    if(placeholderJury != null)
    {
      placeholderJury.removeProfessor(this);
    }
  }

}



//%% NEW FILE Jury BEGINS HERE %%

/*PLEASE DO NOT EDIT THIS CODE*/
/*This code was generated using the UMPLE 1.29.1.4448.81a70243a modeling language!*/


import java.util.*;

// line 6 "model.ump"
// line 33 "model.ump"
public class Jury
{

  //------------------------
  // MEMBER VARIABLES
  //------------------------

  //Jury Associations
  private List<Project> project;
  private List<Professor> professors;

  //------------------------
  // CONSTRUCTOR
  //------------------------

  public Jury()
  {
    project = new ArrayList<Project>();
    professors = new ArrayList<Professor>();
  }

  //------------------------
  // INTERFACE
  //------------------------
  /* Code from template association_GetMany */
  public Project getProject(int index)
  {
    Project aProject = project.get(index);
    return aProject;
  }

  public List<Project> getProject()
  {
    List<Project> newProject = Collections.unmodifiableList(project);
    return newProject;
  }

  public int numberOfProject()
  {
    int number = project.size();
    return number;
  }

  public boolean hasProject()
  {
    boolean has = project.size() > 0;
    return has;
  }

  public int indexOfProject(Project aProject)
  {
    int index = project.indexOf(aProject);
    return index;
  }
  /* Code from template association_GetMany */
  public Professor getProfessor(int index)
  {
    Professor aProfessor = professors.get(index);
    return aProfessor;
  }

  public List<Professor> getProfessors()
  {
    List<Professor> newProfessors = Collections.unmodifiableList(professors);
    return newProfessors;
  }

  public int numberOfProfessors()
  {
    int number = professors.size();
    return number;
  }

  public boolean hasProfessors()
  {
    boolean has = professors.size() > 0;
    return has;
  }

  public int indexOfProfessor(Professor aProfessor)
  {
    int index = professors.indexOf(aProfessor);
    return index;
  }
  /* Code from template association_IsNumberOfValidMethod */
  public boolean isNumberOfProjectValid()
  {
    boolean isValid = numberOfProject() >= minimumNumberOfProject();
    return isValid;
  }
  /* Code from template association_MinimumNumberOfMethod */
  public static int minimumNumberOfProject()
  {
    return 1;
  }
  /* Code from template association_AddMandatoryManyToOne */
  public Project addProject(Expoteam aExpoteam)
  {
    Project aNewProject = new Project(aExpoteam, this);
    return aNewProject;
  }

  public boolean addProject(Project aProject)
  {
    boolean wasAdded = false;
    if (project.contains(aProject)) { return false; }
    Jury existingJury = aProject.getJury();
    boolean isNewJury = existingJury != null && !this.equals(existingJury);

    if (isNewJury && existingJury.numberOfProject() <= minimumNumberOfProject())
    {
      return wasAdded;
    }
    if (isNewJury)
    {
      aProject.setJury(this);
    }
    else
    {
      project.add(aProject);
    }
    wasAdded = true;
    return wasAdded;
  }

  public boolean removeProject(Project aProject)
  {
    boolean wasRemoved = false;
    //Unable to remove aProject, as it must always have a jury
    if (this.equals(aProject.getJury()))
    {
      return wasRemoved;
    }

    //jury already at minimum (1)
    if (numberOfProject() <= minimumNumberOfProject())
    {
      return wasRemoved;
    }

    project.remove(aProject);
    wasRemoved = true;
    return wasRemoved;
  }
  /* Code from template association_AddIndexControlFunctions */
  public boolean addProjectAt(Project aProject, int index)
  {  
    boolean wasAdded = false;
    if(addProject(aProject))
    {
      if(index < 0 ) { index = 0; }
      if(index > numberOfProject()) { index = numberOfProject() - 1; }
      project.remove(aProject);
      project.add(index, aProject);
      wasAdded = true;
    }
    return wasAdded;
  }

  public boolean addOrMoveProjectAt(Project aProject, int index)
  {
    boolean wasAdded = false;
    if(project.contains(aProject))
    {
      if(index < 0 ) { index = 0; }
      if(index > numberOfProject()) { index = numberOfProject() - 1; }
      project.remove(aProject);
      project.add(index, aProject);
      wasAdded = true;
    } 
    else 
    {
      wasAdded = addProjectAt(aProject, index);
    }
    return wasAdded;
  }
  /* Code from template association_IsNumberOfValidMethod */
  public boolean isNumberOfProfessorsValid()
  {
    boolean isValid = numberOfProfessors() >= minimumNumberOfProfessors();
    return isValid;
  }
  /* Code from template association_MinimumNumberOfMethod */
  public static int minimumNumberOfProfessors()
  {
    return 1;
  }
  /* Code from template association_AddMandatoryManyToOne */
  public Professor addProfessor()
  {
    Professor aNewProfessor = new Professor(this);
    return aNewProfessor;
  }

  public boolean addProfessor(Professor aProfessor)
  {
    boolean wasAdded = false;
    if (professors.contains(aProfessor)) { return false; }
    Jury existingJury = aProfessor.getJury();
    boolean isNewJury = existingJury != null && !this.equals(existingJury);

    if (isNewJury && existingJury.numberOfProfessors() <= minimumNumberOfProfessors())
    {
      return wasAdded;
    }
    if (isNewJury)
    {
      aProfessor.setJury(this);
    }
    else
    {
      professors.add(aProfessor);
    }
    wasAdded = true;
    return wasAdded;
  }

  public boolean removeProfessor(Professor aProfessor)
  {
    boolean wasRemoved = false;
    //Unable to remove aProfessor, as it must always have a jury
    if (this.equals(aProfessor.getJury()))
    {
      return wasRemoved;
    }

    //jury already at minimum (1)
    if (numberOfProfessors() <= minimumNumberOfProfessors())
    {
      return wasRemoved;
    }

    professors.remove(aProfessor);
    wasRemoved = true;
    return wasRemoved;
  }
  /* Code from template association_AddIndexControlFunctions */
  public boolean addProfessorAt(Professor aProfessor, int index)
  {  
    boolean wasAdded = false;
    if(addProfessor(aProfessor))
    {
      if(index < 0 ) { index = 0; }
      if(index > numberOfProfessors()) { index = numberOfProfessors() - 1; }
      professors.remove(aProfessor);
      professors.add(index, aProfessor);
      wasAdded = true;
    }
    return wasAdded;
  }

  public boolean addOrMoveProfessorAt(Professor aProfessor, int index)
  {
    boolean wasAdded = false;
    if(professors.contains(aProfessor))
    {
      if(index < 0 ) { index = 0; }
      if(index > numberOfProfessors()) { index = numberOfProfessors() - 1; }
      professors.remove(aProfessor);
      professors.add(index, aProfessor);
      wasAdded = true;
    } 
    else 
    {
      wasAdded = addProfessorAt(aProfessor, index);
    }
    return wasAdded;
  }

  public void delete()
  {
    for(int i=project.size(); i > 0; i--)
    {
      Project aProject = project.get(i - 1);
      aProject.delete();
    }
    for(int i=professors.size(); i > 0; i--)
    {
      Professor aProfessor = professors.get(i - 1);
      aProfessor.delete();
    }
  }

}



//%% NEW FILE Expoteam BEGINS HERE %%

/*PLEASE DO NOT EDIT THIS CODE*/
/*This code was generated using the UMPLE 1.29.1.4448.81a70243a modeling language!*/


import java.util.*;

// line 11 "model.ump"
// line 39 "model.ump"
public class Expoteam
{

  //------------------------
  // MEMBER VARIABLES
  //------------------------

  //Expoteam Associations
  private List<Student> students;
  private Project project;

  //------------------------
  // CONSTRUCTOR
  //------------------------

  public Expoteam(Project aProject)
  {
    students = new ArrayList<Student>();
    if (aProject == null || aProject.getExpoteam() != null)
    {
      throw new RuntimeException("Unable to create Expoteam due to aProject");
    }
    project = aProject;
  }

  public Expoteam(Jury aJuryForProject)
  {
    students = new ArrayList<Student>();
    project = new Project(this, aJuryForProject);
  }

  //------------------------
  // INTERFACE
  //------------------------
  /* Code from template association_GetMany */
  public Student getStudent(int index)
  {
    Student aStudent = students.get(index);
    return aStudent;
  }

  public List<Student> getStudents()
  {
    List<Student> newStudents = Collections.unmodifiableList(students);
    return newStudents;
  }

  public int numberOfStudents()
  {
    int number = students.size();
    return number;
  }

  public boolean hasStudents()
  {
    boolean has = students.size() > 0;
    return has;
  }

  public int indexOfStudent(Student aStudent)
  {
    int index = students.indexOf(aStudent);
    return index;
  }
  /* Code from template association_GetOne */
  public Project getProject()
  {
    return project;
  }
  /* Code from template association_IsNumberOfValidMethod */
  public boolean isNumberOfStudentsValid()
  {
    boolean isValid = numberOfStudents() >= minimumNumberOfStudents() && numberOfStudents() <= maximumNumberOfStudents();
    return isValid;
  }
  /* Code from template association_MinimumNumberOfMethod */
  public static int minimumNumberOfStudents()
  {
    return 1;
  }
  /* Code from template association_MaximumNumberOfMethod */
  public static int maximumNumberOfStudents()
  {
    return 4;
  }
  /* Code from template association_AddMNToOnlyOne */
  public Student addStudent()
  {
    if (numberOfStudents() >= maximumNumberOfStudents())
    {
      return null;
    }
    else
    {
      return new Student(this);
    }
  }

  public boolean addStudent(Student aStudent)
  {
    boolean wasAdded = false;
    if (students.contains(aStudent)) { return false; }
    if (numberOfStudents() >= maximumNumberOfStudents())
    {
      return wasAdded;
    }

    Expoteam existingExpoteam = aStudent.getExpoteam();
    boolean isNewExpoteam = existingExpoteam != null && !this.equals(existingExpoteam);

    if (isNewExpoteam && existingExpoteam.numberOfStudents() <= minimumNumberOfStudents())
    {
      return wasAdded;
    }

    if (isNewExpoteam)
    {
      aStudent.setExpoteam(this);
    }
    else
    {
      students.add(aStudent);
    }
    wasAdded = true;
    return wasAdded;
  }

  public boolean removeStudent(Student aStudent)
  {
    boolean wasRemoved = false;
    //Unable to remove aStudent, as it must always have a expoteam
    if (this.equals(aStudent.getExpoteam()))
    {
      return wasRemoved;
    }

    //expoteam already at minimum (1)
    if (numberOfStudents() <= minimumNumberOfStudents())
    {
      return wasRemoved;
    }
    students.remove(aStudent);
    wasRemoved = true;
    return wasRemoved;
  }
  /* Code from template association_AddIndexControlFunctions */
  public boolean addStudentAt(Student aStudent, int index)
  {  
    boolean wasAdded = false;
    if(addStudent(aStudent))
    {
      if(index < 0 ) { index = 0; }
      if(index > numberOfStudents()) { index = numberOfStudents() - 1; }
      students.remove(aStudent);
      students.add(index, aStudent);
      wasAdded = true;
    }
    return wasAdded;
  }

  public boolean addOrMoveStudentAt(Student aStudent, int index)
  {
    boolean wasAdded = false;
    if(students.contains(aStudent))
    {
      if(index < 0 ) { index = 0; }
      if(index > numberOfStudents()) { index = numberOfStudents() - 1; }
      students.remove(aStudent);
      students.add(index, aStudent);
      wasAdded = true;
    } 
    else 
    {
      wasAdded = addStudentAt(aStudent, index);
    }
    return wasAdded;
  }

  public void delete()
  {
    for(int i=students.size(); i > 0; i--)
    {
      Student aStudent = students.get(i - 1);
      aStudent.delete();
    }
    Project existingProject = project;
    project = null;
    if (existingProject != null)
    {
      existingProject.delete();
    }
  }

}



//%% NEW FILE Project BEGINS HERE %%

/*PLEASE DO NOT EDIT THIS CODE*/
/*This code was generated using the UMPLE 1.29.1.4448.81a70243a modeling language!*/


import java.util.*;

// line 19 "model.ump"
// line 50 "model.ump"
public class Project
{

  //------------------------
  // MEMBER VARIABLES
  //------------------------

  //Project Associations
  private Expoteam expoteam;
  private List<Spectator> spectarors;
  private Jury jury;

  //------------------------
  // CONSTRUCTOR
  //------------------------

  public Project(Expoteam aExpoteam, Jury aJury)
  {
    if (aExpoteam == null || aExpoteam.getProject() != null)
    {
      throw new RuntimeException("Unable to create Project due to aExpoteam");
    }
    expoteam = aExpoteam;
    spectarors = new ArrayList<Spectator>();
    boolean didAddJury = setJury(aJury);
    if (!didAddJury)
    {
      throw new RuntimeException("Unable to create project due to jury");
    }
  }

  public Project(Jury aJury)
  {
    expoteam = new Expoteam(this);
    spectarors = new ArrayList<Spectator>();
    boolean didAddJury = setJury(aJury);
    if (!didAddJury)
    {
      throw new RuntimeException("Unable to create project due to jury");
    }
  }

  //------------------------
  // INTERFACE
  //------------------------
  /* Code from template association_GetOne */
  public Expoteam getExpoteam()
  {
    return expoteam;
  }
  /* Code from template association_GetMany */
  public Spectator getSpectaror(int index)
  {
    Spectator aSpectaror = spectarors.get(index);
    return aSpectaror;
  }

  public List<Spectator> getSpectarors()
  {
    List<Spectator> newSpectarors = Collections.unmodifiableList(spectarors);
    return newSpectarors;
  }

  public int numberOfSpectarors()
  {
    int number = spectarors.size();
    return number;
  }

  public boolean hasSpectarors()
  {
    boolean has = spectarors.size() > 0;
    return has;
  }

  public int indexOfSpectaror(Spectator aSpectaror)
  {
    int index = spectarors.indexOf(aSpectaror);
    return index;
  }
  /* Code from template association_GetOne */
  public Jury getJury()
  {
    return jury;
  }
  /* Code from template association_MinimumNumberOfMethod */
  public static int minimumNumberOfSpectarors()
  {
    return 0;
  }
  /* Code from template association_AddManyToManyMethod */
  public boolean addSpectaror(Spectator aSpectaror)
  {
    boolean wasAdded = false;
    if (spectarors.contains(aSpectaror)) { return false; }
    spectarors.add(aSpectaror);
    if (aSpectaror.indexOfProject(this) != -1)
    {
      wasAdded = true;
    }
    else
    {
      wasAdded = aSpectaror.addProject(this);
      if (!wasAdded)
      {
        spectarors.remove(aSpectaror);
      }
    }
    return wasAdded;
  }
  /* Code from template association_RemoveMany */
  public boolean removeSpectaror(Spectator aSpectaror)
  {
    boolean wasRemoved = false;
    if (!spectarors.contains(aSpectaror))
    {
      return wasRemoved;
    }

    int oldIndex = spectarors.indexOf(aSpectaror);
    spectarors.remove(oldIndex);
    if (aSpectaror.indexOfProject(this) == -1)
    {
      wasRemoved = true;
    }
    else
    {
      wasRemoved = aSpectaror.removeProject(this);
      if (!wasRemoved)
      {
        spectarors.add(oldIndex,aSpectaror);
      }
    }
    return wasRemoved;
  }
  /* Code from template association_AddIndexControlFunctions */
  public boolean addSpectarorAt(Spectator aSpectaror, int index)
  {  
    boolean wasAdded = false;
    if(addSpectaror(aSpectaror))
    {
      if(index < 0 ) { index = 0; }
      if(index > numberOfSpectarors()) { index = numberOfSpectarors() - 1; }
      spectarors.remove(aSpectaror);
      spectarors.add(index, aSpectaror);
      wasAdded = true;
    }
    return wasAdded;
  }

  public boolean addOrMoveSpectarorAt(Spectator aSpectaror, int index)
  {
    boolean wasAdded = false;
    if(spectarors.contains(aSpectaror))
    {
      if(index < 0 ) { index = 0; }
      if(index > numberOfSpectarors()) { index = numberOfSpectarors() - 1; }
      spectarors.remove(aSpectaror);
      spectarors.add(index, aSpectaror);
      wasAdded = true;
    } 
    else 
    {
      wasAdded = addSpectarorAt(aSpectaror, index);
    }
    return wasAdded;
  }
  /* Code from template association_SetOneToMandatoryMany */
  public boolean setJury(Jury aJury)
  {
    boolean wasSet = false;
    //Must provide jury to project
    if (aJury == null)
    {
      return wasSet;
    }

    if (jury != null && jury.numberOfProject() <= Jury.minimumNumberOfProject())
    {
      return wasSet;
    }

    Jury existingJury = jury;
    jury = aJury;
    if (existingJury != null && !existingJury.equals(aJury))
    {
      boolean didRemove = existingJury.removeProject(this);
      if (!didRemove)
      {
        jury = existingJury;
        return wasSet;
      }
    }
    jury.addProject(this);
    wasSet = true;
    return wasSet;
  }

  public void delete()
  {
    Expoteam existingExpoteam = expoteam;
    expoteam = null;
    if (existingExpoteam != null)
    {
      existingExpoteam.delete();
    }
    ArrayList<Spectator> copyOfSpectarors = new ArrayList<Spectator>(spectarors);
    spectarors.clear();
    for(Spectator aSpectaror : copyOfSpectarors)
    {
      if (aSpectaror.numberOfProjects() <= Spectator.minimumNumberOfProjects())
      {
        aSpectaror.delete();
      }
      else
      {
        aSpectaror.removeProject(this);
      }
    }
    Jury placeholderJury = jury;
    this.jury = null;
    if(placeholderJury != null)
    {
      placeholderJury.removeProject(this);
    }
  }

}



//%% NEW FILE Spectator BEGINS HERE %%

/*PLEASE DO NOT EDIT THIS CODE*/
/*This code was generated using the UMPLE 1.29.1.4448.81a70243a modeling language!*/


import java.util.*;

// line 24 "model.ump"
// line 57 "model.ump"
public class Spectator
{

  //------------------------
  // MEMBER VARIABLES
  //------------------------

  //Spectator Associations
  private List<Project> projects;

  //------------------------
  // CONSTRUCTOR
  //------------------------

  public Spectator(Project... allProjects)
  {
    projects = new ArrayList<Project>();
    boolean didAddProjects = setProjects(allProjects);
    if (!didAddProjects)
    {
      throw new RuntimeException("Unable to create Spectator, must have at least 1 projects");
    }
  }

  //------------------------
  // INTERFACE
  //------------------------
  /* Code from template association_GetMany */
  public Project getProject(int index)
  {
    Project aProject = projects.get(index);
    return aProject;
  }

  public List<Project> getProjects()
  {
    List<Project> newProjects = Collections.unmodifiableList(projects);
    return newProjects;
  }

  public int numberOfProjects()
  {
    int number = projects.size();
    return number;
  }

  public boolean hasProjects()
  {
    boolean has = projects.size() > 0;
    return has;
  }

  public int indexOfProject(Project aProject)
  {
    int index = projects.indexOf(aProject);
    return index;
  }
  /* Code from template association_IsNumberOfValidMethod */
  public boolean isNumberOfProjectsValid()
  {
    boolean isValid = numberOfProjects() >= minimumNumberOfProjects();
    return isValid;
  }
  /* Code from template association_MinimumNumberOfMethod */
  public static int minimumNumberOfProjects()
  {
    return 1;
  }
  /* Code from template association_AddManyToManyMethod */
  public boolean addProject(Project aProject)
  {
    boolean wasAdded = false;
    if (projects.contains(aProject)) { return false; }
    projects.add(aProject);
    if (aProject.indexOfSpectaror(this) != -1)
    {
      wasAdded = true;
    }
    else
    {
      wasAdded = aProject.addSpectaror(this);
      if (!wasAdded)
      {
        projects.remove(aProject);
      }
    }
    return wasAdded;
  }
  /* Code from template association_AddMStarToMany */
  public boolean removeProject(Project aProject)
  {
    boolean wasRemoved = false;
    if (!projects.contains(aProject))
    {
      return wasRemoved;
    }

    if (numberOfProjects() <= minimumNumberOfProjects())
    {
      return wasRemoved;
    }

    int oldIndex = projects.indexOf(aProject);
    projects.remove(oldIndex);
    if (aProject.indexOfSpectaror(this) == -1)
    {
      wasRemoved = true;
    }
    else
    {
      wasRemoved = aProject.removeSpectaror(this);
      if (!wasRemoved)
      {
        projects.add(oldIndex,aProject);
      }
    }
    return wasRemoved;
  }
  /* Code from template association_SetMStarToMany */
  public boolean setProjects(Project... newProjects)
  {
    boolean wasSet = false;
    ArrayList<Project> verifiedProjects = new ArrayList<Project>();
    for (Project aProject : newProjects)
    {
      if (verifiedProjects.contains(aProject))
      {
        continue;
      }
      verifiedProjects.add(aProject);
    }

    if (verifiedProjects.size() != newProjects.length || verifiedProjects.size() < minimumNumberOfProjects())
    {
      return wasSet;
    }

    ArrayList<Project> oldProjects = new ArrayList<Project>(projects);
    projects.clear();
    for (Project aNewProject : verifiedProjects)
    {
      projects.add(aNewProject);
      if (oldProjects.contains(aNewProject))
      {
        oldProjects.remove(aNewProject);
      }
      else
      {
        aNewProject.addSpectaror(this);
      }
    }

    for (Project anOldProject : oldProjects)
    {
      anOldProject.removeSpectaror(this);
    }
    wasSet = true;
    return wasSet;
  }
  /* Code from template association_AddIndexControlFunctions */
  public boolean addProjectAt(Project aProject, int index)
  {  
    boolean wasAdded = false;
    if(addProject(aProject))
    {
      if(index < 0 ) { index = 0; }
      if(index > numberOfProjects()) { index = numberOfProjects() - 1; }
      projects.remove(aProject);
      projects.add(index, aProject);
      wasAdded = true;
    }
    return wasAdded;
  }

  public boolean addOrMoveProjectAt(Project aProject, int index)
  {
    boolean wasAdded = false;
    if(projects.contains(aProject))
    {
      if(index < 0 ) { index = 0; }
      if(index > numberOfProjects()) { index = numberOfProjects() - 1; }
      projects.remove(aProject);
      projects.add(index, aProject);
      wasAdded = true;
    } 
    else 
    {
      wasAdded = addProjectAt(aProject, index);
    }
    return wasAdded;
  }

  public void delete()
  {
    ArrayList<Project> copyOfProjects = new ArrayList<Project>(projects);
    projects.clear();
    for(Project aProject : copyOfProjects)
    {
      aProject.removeSpectaror(this);
    }
  }

}



//%% NEW FILE Student BEGINS HERE %%

/*PLEASE DO NOT EDIT THIS CODE*/
/*This code was generated using the UMPLE 1.29.1.4448.81a70243a modeling language!*/



// line 15 "model.ump"
// line 45 "model.ump"
public class Student
{

  //------------------------
  // MEMBER VARIABLES
  //------------------------

  //Student Associations
  private Expoteam expoteam;

  //------------------------
  // CONSTRUCTOR
  //------------------------

  public Student(Expoteam aExpoteam)
  {
    boolean didAddExpoteam = setExpoteam(aExpoteam);
    if (!didAddExpoteam)
    {
      throw new RuntimeException("Unable to create student due to expoteam");
    }
  }

  //------------------------
  // INTERFACE
  //------------------------
  /* Code from template association_GetOne */
  public Expoteam getExpoteam()
  {
    return expoteam;
  }
  /* Code from template association_SetOneToAtMostN */
  public boolean setExpoteam(Expoteam aExpoteam)
  {
    boolean wasSet = false;
    //Must provide expoteam to student
    if (aExpoteam == null)
    {
      return wasSet;
    }

    //expoteam already at maximum (4)
    if (aExpoteam.numberOfStudents() >= Expoteam.maximumNumberOfStudents())
    {
      return wasSet;
    }
    
    Expoteam existingExpoteam = expoteam;
    expoteam = aExpoteam;
    if (existingExpoteam != null && !existingExpoteam.equals(aExpoteam))
    {
      boolean didRemove = existingExpoteam.removeStudent(this);
      if (!didRemove)
      {
        expoteam = existingExpoteam;
        return wasSet;
      }
    }
    expoteam.addStudent(this);
    wasSet = true;
    return wasSet;
  }

  public void delete()
  {
    Expoteam placeholderExpoteam = expoteam;
    this.expoteam = null;
    if(placeholderExpoteam != null)
    {
      placeholderExpoteam.removeStudent(this);
    }
  }

}
