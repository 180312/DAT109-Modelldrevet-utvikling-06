//%% NEW FILE Professor BEGINS HERE %%


/*PLEASE DO NOT EDIT THIS CODE*/
/*This code was generated using the UMPLE 1.29.1.4448.81a70243a modeling language!*/

class Professor
{

  //------------------------
  // MEMBER VARIABLES
  //------------------------

  //Professor Associations
  private $jury;

  //------------------------
  // CONSTRUCTOR
  //------------------------

  public function __construct($aJury)
  {
    $didAddJury = $this->setJury($aJury);
    if (!$didAddJury)
    {
      throw new Exception("Unable to create professor due to jury");
    }
  }

  //------------------------
  // INTERFACE
  //------------------------

  public function getJury()
  {
    return $this->jury;
  }

  public function setJury($aJury)
  {
    $wasSet = false;
    //Must provide jury to professor
    if ($aJury == null)
    {
      return $wasSet;
    }

    if ($this->jury != null && $this->jury->numberOfProfessors() <= Jury::minimumNumberOfProfessors())
    {
      return $wasSet;
    }

    $existingJury = $this->jury;
    $this->jury = $aJury;
    if ($existingJury != null && $existingJury != $aJury)
    {
      $didRemove = $existingJury->removeProfessor($this);
      if (!$didRemove)
      {
        $this->jury = $existingJury;
        return $wasSet;
      }
    }
    $this->jury->addProfessor($this);
    $wasSet = true;
    return $wasSet;
  }

  public function equals($compareTo)
  {
    return $this == $compareTo;
  }

  public function delete()
  {
    $placeholderJury = $this->jury;
    $this->jury = null;
    $placeholderJury->removeProfessor($this);
  }

}




//%% NEW FILE Jury BEGINS HERE %%


/*PLEASE DO NOT EDIT THIS CODE*/
/*This code was generated using the UMPLE 1.29.1.4448.81a70243a modeling language!*/

class Jury
{

  //------------------------
  // MEMBER VARIABLES
  //------------------------

  //Jury Associations
  private $project;
  private $professors;

  //------------------------
  // CONSTRUCTOR
  //------------------------

  public function __construct()
  {
    $this->project = array();
    $this->professors = array();
  }

  //------------------------
  // INTERFACE
  //------------------------

  public function getProject_index($index)
  {
    $aProject = $this->project[$index];
    return $aProject;
  }

  public function getProject()
  {
    $newProject = $this->project;
    return $newProject;
  }

  public function numberOfProject()
  {
    $number = count($this->project);
    return $number;
  }

  public function hasProject()
  {
    $has = $this->numberOfProject() > 0;
    return $has;
  }

  public function indexOfProject($aProject)
  {
    $wasFound = false;
    $index = 0;
    foreach($this->project as $project)
    {
      if ($project->equals($aProject))
      {
        $wasFound = true;
        break;
      }
      $index += 1;
    }
    $index = $wasFound ? $index : -1;
    return $index;
  }

  public function getProfessor_index($index)
  {
    $aProfessor = $this->professors[$index];
    return $aProfessor;
  }

  public function getProfessors()
  {
    $newProfessors = $this->professors;
    return $newProfessors;
  }

  public function numberOfProfessors()
  {
    $number = count($this->professors);
    return $number;
  }

  public function hasProfessors()
  {
    $has = $this->numberOfProfessors() > 0;
    return $has;
  }

  public function indexOfProfessor($aProfessor)
  {
    $wasFound = false;
    $index = 0;
    foreach($this->professors as $professor)
    {
      if ($professor->equals($aProfessor))
      {
        $wasFound = true;
        break;
      }
      $index += 1;
    }
    $index = $wasFound ? $index : -1;
    return $index;
  }

  public function isNumberOfProjectValid()
  {
    $isValid = $this->numberOfProject() >= self::minimumNumberOfProject();
    return $isValid;
  }

  public static function minimumNumberOfProject()
  {
    return 1;
  }

  public function addProjectVia($aExpoteam)
  {
    return new Project($aExpoteam, $this);
  }

  public function addProject($aProject)
  {
    $wasAdded = false;
    if ($this->indexOfProject($aProject) !== -1) { return false; }
    $existingJury = $aProject->getJury();
    $isNewJury = $existingJury != null && $this !== $existingJury;

    if ($isNewJury && $existingJury->numberOfProject() <= self::minimumNumberOfProject())
    {
      return $wasAdded;
    }

    if ($isNewJury)
    {
      $aProject->setJury($this);
    }
    else
    {
      $this->project[] = $aProject;
    }
    $wasAdded = true;
    return $wasAdded;
  }

  public function removeProject($aProject)
  {
    $wasRemoved = false;
    //Unable to remove aProject, as it must always have a jury
    if ($this === $aProject->getJury())
    {
      return $wasRemoved;
    }

    //jury already at minimum (1)
    if ($this->numberOfProject() <= self::minimumNumberOfProject())
    {
      return $wasRemoved;
    }

    unset($this->project[$this->indexOfProject($aProject)]);
    $this->project = array_values($this->project);
    $wasRemoved = true;
    return $wasRemoved;
  }

  public function addProjectAt($aProject, $index)
  {  
    $wasAdded = false;
    if($this->addProject($aProject))
    {
      if($index < 0 ) { $index = 0; }
      if($index > $this->numberOfProject()) { $index = $this->numberOfProject() - 1; }
      array_splice($this->project, $this->indexOfProject($aProject), 1);
      array_splice($this->project, $index, 0, array($aProject));
      $wasAdded = true;
    }
    return $wasAdded;
  }

  public function addOrMoveProjectAt($aProject, $index)
  {
    $wasAdded = false;
    if($this->indexOfProject($aProject) !== -1)
    {
      if($index < 0 ) { $index = 0; }
      if($index > $this->numberOfProject()) { $index = $this->numberOfProject() - 1; }
      array_splice($this->project, $this->indexOfProject($aProject), 1);
      array_splice($this->project, $index, 0, array($aProject));
      $wasAdded = true;
    } 
    else 
    {
      $wasAdded = $this->addProjectAt($aProject, $index);
    }
    return $wasAdded;
  }

  public function isNumberOfProfessorsValid()
  {
    $isValid = $this->numberOfProfessors() >= self::minimumNumberOfProfessors();
    return $isValid;
  }

  public static function minimumNumberOfProfessors()
  {
    return 1;
  }

  public function addProfessorVia()
  {
    return new Professor($this);
  }

  public function addProfessor($aProfessor)
  {
    $wasAdded = false;
    if ($this->indexOfProfessor($aProfessor) !== -1) { return false; }
    $existingJury = $aProfessor->getJury();
    $isNewJury = $existingJury != null && $this !== $existingJury;

    if ($isNewJury && $existingJury->numberOfProfessors() <= self::minimumNumberOfProfessors())
    {
      return $wasAdded;
    }

    if ($isNewJury)
    {
      $aProfessor->setJury($this);
    }
    else
    {
      $this->professors[] = $aProfessor;
    }
    $wasAdded = true;
    return $wasAdded;
  }

  public function removeProfessor($aProfessor)
  {
    $wasRemoved = false;
    //Unable to remove aProfessor, as it must always have a jury
    if ($this === $aProfessor->getJury())
    {
      return $wasRemoved;
    }

    //jury already at minimum (1)
    if ($this->numberOfProfessors() <= self::minimumNumberOfProfessors())
    {
      return $wasRemoved;
    }

    unset($this->professors[$this->indexOfProfessor($aProfessor)]);
    $this->professors = array_values($this->professors);
    $wasRemoved = true;
    return $wasRemoved;
  }

  public function addProfessorAt($aProfessor, $index)
  {  
    $wasAdded = false;
    if($this->addProfessor($aProfessor))
    {
      if($index < 0 ) { $index = 0; }
      if($index > $this->numberOfProfessors()) { $index = $this->numberOfProfessors() - 1; }
      array_splice($this->professors, $this->indexOfProfessor($aProfessor), 1);
      array_splice($this->professors, $index, 0, array($aProfessor));
      $wasAdded = true;
    }
    return $wasAdded;
  }

  public function addOrMoveProfessorAt($aProfessor, $index)
  {
    $wasAdded = false;
    if($this->indexOfProfessor($aProfessor) !== -1)
    {
      if($index < 0 ) { $index = 0; }
      if($index > $this->numberOfProfessors()) { $index = $this->numberOfProfessors() - 1; }
      array_splice($this->professors, $this->indexOfProfessor($aProfessor), 1);
      array_splice($this->professors, $index, 0, array($aProfessor));
      $wasAdded = true;
    } 
    else 
    {
      $wasAdded = $this->addProfessorAt($aProfessor, $index);
    }
    return $wasAdded;
  }

  public function equals($compareTo)
  {
    return $this == $compareTo;
  }

  public function delete()
  {
    foreach ($this->project as $aProject)
    {
      $aProject->delete();
    }
    foreach ($this->professors as $aProfessor)
    {
      $aProfessor->delete();
    }
  }

}




//%% NEW FILE Expoteam BEGINS HERE %%


/*PLEASE DO NOT EDIT THIS CODE*/
/*This code was generated using the UMPLE 1.29.1.4448.81a70243a modeling language!*/

class Expoteam
{

  //------------------------
  // MEMBER VARIABLES
  //------------------------

  //Expoteam Associations
  private $students;
  private $project;

  //------------------------
  // CONSTRUCTOR
  //------------------------

  public function __construct($aProject = null)
  {
    if (func_num_args() == 0) { return; }

    $this->students = array();
    if ($aProject == null || $aProject->getExpoteam() != null)
    {
      throw new Exception("Unable to create Expoteam due to aProject");
    }
    $this->project = $aProject;
  }
  public static function newInstance($aJuryForProject)
  {
    $thisInstance = new Expoteam();
    $thisInstance->students = array();
    $didAddStudents = $thisInstance->setStudents($allStudents);
    if (!$didAddStudents)
    {
      throw new Exception("Unable to create Expoteam, must have 1 to 4 students");
    }
    $thisInstance->project = new Project($thisInstance, $aJuryForProject);
    return $thisInstance;
  }

  //------------------------
  // INTERFACE
  //------------------------

  public function getStudent_index($index)
  {
    $aStudent = $this->students[$index];
    return $aStudent;
  }

  public function getStudents()
  {
    $newStudents = $this->students;
    return $newStudents;
  }

  public function numberOfStudents()
  {
    $number = count($this->students);
    return $number;
  }

  public function hasStudents()
  {
    $has = $this->numberOfStudents() > 0;
    return $has;
  }

  public function indexOfStudent($aStudent)
  {
    $wasFound = false;
    $index = 0;
    foreach($this->students as $student)
    {
      if ($student->equals($aStudent))
      {
        $wasFound = true;
        break;
      }
      $index += 1;
    }
    $index = $wasFound ? $index : -1;
    return $index;
  }

  public function getProject()
  {
    return $this->project;
  }

  public function isNumberOfStudentsValid()
  {
    $isValid = $this->numberOfStudents() >= self::minimumNumberOfStudents() && $this->numberOfStudents() <= self::maximumNumberOfStudents();
    return $isValid;
  }

  public static function minimumNumberOfStudents()
  {
    return 1;
  }

  public static function maximumNumberOfStudents()
  {
    return 4;
  }

  public function addStudentVia()
  {
    if ($this->numberOfStudents() >= self::maximumNumberOfStudents())
    {
      return null;
    }
    else
    {
      return new Student($this);
    }
  }

  public function addStudent($aStudent)
  {
    $wasAdded = false;
    if ($this->indexOfStudent($aStudent) !== -1) { return false; }
    if ($this->numberOfStudents() >= self::maximumNumberOfStudents())
    {
      return $wasAdded;
    }

    $existingExpoteam = $aStudent->getExpoteam();
    $isNewExpoteam = $existingExpoteam != null && $this !== $existingExpoteam;

    if ($isNewExpoteam && $existingExpoteam->numberOfStudents() <= self::minimumNumberOfStudents())
    {
      return $wasAdded;
    }

    if ($isNewExpoteam)
    {
      $aStudent->setExpoteam($this);
    }
    else
    {
      $this->students[] = $aStudent;
    }
    $wasAdded = true;
    return $wasAdded;
  }

  public function removeStudent($aStudent)
  {
    $wasRemoved = false;
    //Unable to remove aStudent, as it must always have a expoteam
    if ($this === $aStudent->getExpoteam())
    {
      return $wasRemoved;
    }

    //expoteam already at minimum (1)
    if ($this->numberOfStudents() <= self::minimumNumberOfStudents())
    {
      return $wasRemoved;
    }

    unset($this->students[$this->indexOfStudent($aStudent)]);
    $this->students = array_values($this->students);
    $wasRemoved = true;
    return $wasRemoved;
  }

  public function addStudentAt($aStudent, $index)
  {  
    $wasAdded = false;
    if($this->addStudent($aStudent))
    {
      if($index < 0 ) { $index = 0; }
      if($index > $this->numberOfStudents()) { $index = $this->numberOfStudents() - 1; }
      array_splice($this->students, $this->indexOfStudent($aStudent), 1);
      array_splice($this->students, $index, 0, array($aStudent));
      $wasAdded = true;
    }
    return $wasAdded;
  }

  public function addOrMoveStudentAt($aStudent, $index)
  {
    $wasAdded = false;
    if($this->indexOfStudent($aStudent) !== -1)
    {
      if($index < 0 ) { $index = 0; }
      if($index > $this->numberOfStudents()) { $index = $this->numberOfStudents() - 1; }
      array_splice($this->students, $this->indexOfStudent($aStudent), 1);
      array_splice($this->students, $index, 0, array($aStudent));
      $wasAdded = true;
    } 
    else 
    {
      $wasAdded = $this->addStudentAt($aStudent, $index);
    }
    return $wasAdded;
  }

  public function equals($compareTo)
  {
    return $this == $compareTo;
  }

  public function delete()
  {
    foreach ($this->students as $aStudent)
    {
      $aStudent->delete();
    }
    $existingProject = $this->project;
    $this->project = null;
    if ($existingProject != null)
    {
      $existingProject->delete();
    }
  }

}




//%% NEW FILE Project BEGINS HERE %%


/*PLEASE DO NOT EDIT THIS CODE*/
/*This code was generated using the UMPLE 1.29.1.4448.81a70243a modeling language!*/

class Project
{

  //------------------------
  // MEMBER VARIABLES
  //------------------------

  //Project Associations
  private $expoteam;
  private $spectarors;
  private $jury;

  //------------------------
  // CONSTRUCTOR
  //------------------------

  public function __construct($aExpoteam = null, $aJury = null)
  {
    if (func_num_args() == 0) { return; }

    if ($aExpoteam == null || $aExpoteam->getProject() != null)
    {
      throw new Exception("Unable to create Project due to aExpoteam");
    }
    $this->expoteam = $aExpoteam;
    $this->spectarors = array();
    $didAddJury = $this->setJury($aJury);
    if (!$didAddJury)
    {
      throw new Exception("Unable to create project due to jury");
    }
  }
  public static function newInstance($aJury)
  {
    $thisInstance = new Project();
    $thisInstance->expoteam = new Expoteam($thisInstance);
    $this->spectarors = array();$this->juries = array();
    $this->juries[] = $aJury;
    return $thisInstance;
  }

  //------------------------
  // INTERFACE
  //------------------------

  public function getExpoteam()
  {
    return $this->expoteam;
  }

  public function getSpectaror_index($index)
  {
    $aSpectaror = $this->spectarors[$index];
    return $aSpectaror;
  }

  public function getSpectarors()
  {
    $newSpectarors = $this->spectarors;
    return $newSpectarors;
  }

  public function numberOfSpectarors()
  {
    $number = count($this->spectarors);
    return $number;
  }

  public function hasSpectarors()
  {
    $has = $this->numberOfSpectarors() > 0;
    return $has;
  }

  public function indexOfSpectaror($aSpectaror)
  {
    $wasFound = false;
    $index = 0;
    foreach($this->spectarors as $spectaror)
    {
      if ($spectaror->equals($aSpectaror))
      {
        $wasFound = true;
        break;
      }
      $index += 1;
    }
    $index = $wasFound ? $index : -1;
    return $index;
  }

  public function getJury()
  {
    return $this->jury;
  }

  public static function minimumNumberOfSpectarors()
  {
    return 0;
  }

  public function addSpectaror($aSpectaror)
  {
    $wasAdded = false;
    if ($this->indexOfSpectaror($aSpectaror) !== -1) { return false; }
    $this->spectarors[] = $aSpectaror;
    if ($aSpectaror->indexOfProject($this) != -1)
    {
      $wasAdded = true;
    }
    else
    {
      $wasAdded = $aSpectaror->addProject($this);
      if (!$wasAdded)
      {
        array_pop($this->spectarors);
      }
    }
    return $wasAdded;
  }

  public function removeSpectaror($aSpectaror)
  {
    $wasRemoved = false;
    if ($this->indexOfSpectaror($aSpectaror) == -1)
    {
      return $wasRemoved;
    }

    $oldIndex = $this->indexOfSpectaror($aSpectaror);
    unset($this->spectarors[$oldIndex]);
    if ($aSpectaror->indexOfProject($this) == -1)
    {
      $wasRemoved = true;
    }
    else
    {
      $wasRemoved = $aSpectaror->removeProject($this);
      if (!$wasRemoved)
      {
        $this->spectarors[$oldIndex] = $aSpectaror;
        ksort($this->spectarors);
      }
    }
    $this->spectarors = array_values($this->spectarors);
    return $wasRemoved;
  }

  public function addSpectarorAt($aSpectaror, $index)
  {  
    $wasAdded = false;
    if($this->addSpectaror($aSpectaror))
    {
      if($index < 0 ) { $index = 0; }
      if($index > $this->numberOfSpectarors()) { $index = $this->numberOfSpectarors() - 1; }
      array_splice($this->spectarors, $this->indexOfSpectaror($aSpectaror), 1);
      array_splice($this->spectarors, $index, 0, array($aSpectaror));
      $wasAdded = true;
    }
    return $wasAdded;
  }

  public function addOrMoveSpectarorAt($aSpectaror, $index)
  {
    $wasAdded = false;
    if($this->indexOfSpectaror($aSpectaror) !== -1)
    {
      if($index < 0 ) { $index = 0; }
      if($index > $this->numberOfSpectarors()) { $index = $this->numberOfSpectarors() - 1; }
      array_splice($this->spectarors, $this->indexOfSpectaror($aSpectaror), 1);
      array_splice($this->spectarors, $index, 0, array($aSpectaror));
      $wasAdded = true;
    } 
    else 
    {
      $wasAdded = $this->addSpectarorAt($aSpectaror, $index);
    }
    return $wasAdded;
  }

  public function setJury($aJury)
  {
    $wasSet = false;
    //Must provide jury to project
    if ($aJury == null)
    {
      return $wasSet;
    }

    if ($this->jury != null && $this->jury->numberOfProject() <= Jury::minimumNumberOfProject())
    {
      return $wasSet;
    }

    $existingJury = $this->jury;
    $this->jury = $aJury;
    if ($existingJury != null && $existingJury != $aJury)
    {
      $didRemove = $existingJury->removeProject($this);
      if (!$didRemove)
      {
        $this->jury = $existingJury;
        return $wasSet;
      }
    }
    $this->jury->addProject($this);
    $wasSet = true;
    return $wasSet;
  }

  public function equals($compareTo)
  {
    return $this == $compareTo;
  }

  public function delete()
  {
    $existingExpoteam = $this->expoteam;
    $this->expoteam = null;
    if ($existingExpoteam != null)
    {
      $existingExpoteam->delete();
    }
    $copyOfSpectarors = $this->spectarors;
    $this->spectarors = array();
    foreach ($copyOfSpectarors as $aSpectaror)
    {
      if ($aSpectaror->numberOfProjects() <= Spectator::minimumNumberOfProjects())
      {
        $aSpectaror->delete();
      }
      else
      {
        $aSpectaror->removeProject($this);
      }
    }
    $placeholderJury = $this->jury;
    $this->jury = null;
    $placeholderJury->removeProject($this);
  }

}




//%% NEW FILE Spectator BEGINS HERE %%


/*PLEASE DO NOT EDIT THIS CODE*/
/*This code was generated using the UMPLE 1.29.1.4448.81a70243a modeling language!*/

class Spectator
{

  //------------------------
  // MEMBER VARIABLES
  //------------------------

  //Spectator Associations
  private $projects;

  //------------------------
  // CONSTRUCTOR
  //------------------------

  public function __construct($allProjects)
  {
    $this->projects = array();
    $didAddProjects = $this->setProjects($allProjects);
    if (!$didAddProjects)
    {
      throw new Exception("Unable to create Spectator, must have at least 1 projects");
    }
  }

  //------------------------
  // INTERFACE
  //------------------------

  public function getProject_index($index)
  {
    $aProject = $this->projects[$index];
    return $aProject;
  }

  public function getProjects()
  {
    $newProjects = $this->projects;
    return $newProjects;
  }

  public function numberOfProjects()
  {
    $number = count($this->projects);
    return $number;
  }

  public function hasProjects()
  {
    $has = $this->numberOfProjects() > 0;
    return $has;
  }

  public function indexOfProject($aProject)
  {
    $wasFound = false;
    $index = 0;
    foreach($this->projects as $project)
    {
      if ($project->equals($aProject))
      {
        $wasFound = true;
        break;
      }
      $index += 1;
    }
    $index = $wasFound ? $index : -1;
    return $index;
  }

  public function isNumberOfProjectsValid()
  {
    $isValid = $this->numberOfProjects() >= self::minimumNumberOfProjects();
    return $isValid;
  }

  public static function minimumNumberOfProjects()
  {
    return 1;
  }

  public function addProject($aProject)
  {
    $wasAdded = false;
    if ($this->indexOfProject($aProject) !== -1) { return false; }
    $this->projects[] = $aProject;
    if ($aProject->indexOfSpectaror($this) != -1)
    {
      $wasAdded = true;
    }
    else
    {
      $wasAdded = $aProject->addSpectaror($this);
      if (!$wasAdded)
      {
        array_pop($this->projects);
      }
    }
    return $wasAdded;
  }

  public function removeProject($aProject)
  {
    $wasRemoved = false;
    if ($this->indexOfProject($aProject) == -1)
    {
      return $wasRemoved;
    }

    if ($this->numberOfProjects() <= self::minimumNumberOfProjects())
    {
      return $wasRemoved;
    }

    $oldIndex = $this->indexOfProject($aProject);
    unset($this->projects[$oldIndex]);
    if ($aProject->indexOfSpectaror($this) == -1)
    {
      $wasRemoved = true;
    }
    else
    {
      $wasRemoved = $aProject->removeSpectaror($this);
      if (!$wasRemoved)
      {
        $this->projects[$oldIndex] = $aProject;
        ksort($this->projects);
      }
    }
    $this->projects = array_values($this->projects);
    return $wasRemoved;
  }

  public function setProjects($newProjects)
  {
    $wasSet = false;
    $verifiedProjects = array();
    foreach ($newProjects as $aProject)
    {
      if (array_search($aProject,$verifiedProjects) !== false)
      {
        continue;
      }
      $verifiedProjects[] = $aProject;
    }

    if (count($verifiedProjects) != count($newProjects) || count($verifiedProjects) < self::minimumNumberOfProjects())
    {
      return $wasSet;
    }

    $oldProjects = $this->projects;
    $this->projects = array();
    foreach ($verifiedProjects as $aNewProject)
    {
      $this->projects[] = $aNewProject;
      $removeIndex = array_search($aNewProject,$oldProjects);
      if ($removeIndex !== false)
      {
        unset($oldProjects[$removeIndex]);
        $oldProjects = array_values($oldProjects);
      }
      else
      {
        $aNewProject->addSpectaror($this);
      }
    }

    foreach ($oldProjects as $anOldProject)
    {
      $anOldProject->removeSpectaror($this);
    }
    $wasSet = true;
    return $wasSet;
  }

  public function addProjectAt($aProject, $index)
  {  
    $wasAdded = false;
    if($this->addProject($aProject))
    {
      if($index < 0 ) { $index = 0; }
      if($index > $this->numberOfProjects()) { $index = $this->numberOfProjects() - 1; }
      array_splice($this->projects, $this->indexOfProject($aProject), 1);
      array_splice($this->projects, $index, 0, array($aProject));
      $wasAdded = true;
    }
    return $wasAdded;
  }

  public function addOrMoveProjectAt($aProject, $index)
  {
    $wasAdded = false;
    if($this->indexOfProject($aProject) !== -1)
    {
      if($index < 0 ) { $index = 0; }
      if($index > $this->numberOfProjects()) { $index = $this->numberOfProjects() - 1; }
      array_splice($this->projects, $this->indexOfProject($aProject), 1);
      array_splice($this->projects, $index, 0, array($aProject));
      $wasAdded = true;
    } 
    else 
    {
      $wasAdded = $this->addProjectAt($aProject, $index);
    }
    return $wasAdded;
  }

  public function equals($compareTo)
  {
    return $this == $compareTo;
  }

  public function delete()
  {
    $copyOfProjects = $this->projects;
    $this->projects = array();
    foreach ($copyOfProjects as $aProject)
    {
      $aProject->removeSpectaror($this);
    }
  }

}




//%% NEW FILE Student BEGINS HERE %%


/*PLEASE DO NOT EDIT THIS CODE*/
/*This code was generated using the UMPLE 1.29.1.4448.81a70243a modeling language!*/

class Student
{

  //------------------------
  // MEMBER VARIABLES
  //------------------------

  //Student Associations
  private $expoteam;

  //------------------------
  // CONSTRUCTOR
  //------------------------

  public function __construct($aExpoteam)
  {
    $didAddExpoteam = $this->setExpoteam($aExpoteam);
    if (!$didAddExpoteam)
    {
      throw new Exception("Unable to create student due to expoteam");
    }
  }

  //------------------------
  // INTERFACE
  //------------------------

  public function getExpoteam()
  {
    return $this->expoteam;
  }

  public function setExpoteam($aExpoteam)
  {
    $wasSet = false;
    //Must provide expoteam to student
    if ($aExpoteam == null)
    {
      return $wasSet;
    }

    //expoteam already at maximum (4)
    if ($aExpoteam->numberOfStudents() >= Expoteam::maximumNumberOfStudents())
    {
      return $wasSet;
    }
    
    $existingExpoteam = $this->expoteam;
    $this->expoteam = $aExpoteam;
    if ($existingExpoteam != null && $existingExpoteam != $aExpoteam)
    {
      $didRemove = $existingExpoteam->removeStudent($this);
      if (!$didRemove)
      {
        $this->expoteam = $existingExpoteam;
        return $wasSet;
      }
    }
    $this->expoteam->addStudent($this);
    $wasSet = true;
    return $wasSet;
  }

  public function equals($compareTo)
  {
    return $this == $compareTo;
  }

  public function delete()
  {
    $placeholderExpoteam = $this->expoteam;
    $this->expoteam = null;
    $placeholderExpoteam->removeStudent($this);
  }

}
