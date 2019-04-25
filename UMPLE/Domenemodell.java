class Professor {
  
}

class Jury {
  1--1..* Expoteam expoteam;
  1--1..* Professor professors;
}

class Expoteam {
  1--4 Project project;
  1--1..* Student students;
}

class Student {
  
}

class Project  {
  1..*--* Spectator spectarors;
}

class Spectator {
  
}
