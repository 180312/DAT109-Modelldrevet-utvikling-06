class Professor {
  
}

class Jury {
  1--1..* Project project;
  1--1..* Professor professors;
}

class Expoteam {
  1--1..4 Student students;
}

class Student {
  
}

class Project  {
  1--1 Expoteam expoteam;
  1..*--* Spectator spectarors;
}

class Spectator {
  
}
