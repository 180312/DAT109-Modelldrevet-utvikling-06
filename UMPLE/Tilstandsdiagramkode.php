//%% NEW FILE HVLexpo BEGINS HERE %%


/*PLEASE DO NOT EDIT THIS CODE*/
/*This code was generated using the UMPLE 1.29.1.4448.81a70243a modeling language!*/

class HVLexpo
{

  //------------------------
  // MEMBER VARIABLES
  //------------------------

  //HVLexpo State Machines
  private static $StateCreateUser = 1;
  private static $StateRoleIsJury = 2;
  private static $StateRoleIsExpoTeam = 3;
  private static $StateRoleIsSpectator = 4;
  private static $StateVoting = 5;
  private static $StateCreatingExpo = 6;
  private static $StateUpdateEvent = 7;
  private static $StateScoreboard = 8;
  private static $StateDeleting = 9;
  private $state;

  //------------------------
  // CONSTRUCTOR
  //------------------------

  public function __construct()
  {
    $this->setState(self::$StateCreateUser);
  }

  //------------------------
  // INTERFACE
  //------------------------

  public function getStateFullName()
  {
    $answer = $this->getState();
    return $answer;
  }

  public function getState()
  {
    if ($this->state == self::$StateCreateUser) { return "StateCreateUser"; }
    elseif ($this->state == self::$StateRoleIsJury) { return "StateRoleIsJury"; }
    elseif ($this->state == self::$StateRoleIsExpoTeam) { return "StateRoleIsExpoTeam"; }
    elseif ($this->state == self::$StateRoleIsSpectator) { return "StateRoleIsSpectator"; }
    elseif ($this->state == self::$StateVoting) { return "StateVoting"; }
    elseif ($this->state == self::$StateCreatingExpo) { return "StateCreatingExpo"; }
    elseif ($this->state == self::$StateUpdateEvent) { return "StateUpdateEvent"; }
    elseif ($this->state == self::$StateScoreboard) { return "StateScoreboard"; }
    elseif ($this->state == self::$StateDeleting) { return "StateDeleting"; }
    return null;
  }

  public function Spectator()
  {
    $wasEventProcessed = false;
    
    $aState = $this->state;
    if ($aState == self::$StateCreateUser)
    {
      $this->setState(self::$StateRoleIsSpectator);
      $wasEventProcessed = true;
    }
    return $wasEventProcessed;
  }

  public function Jury()
  {
    $wasEventProcessed = false;
    
    $aState = $this->state;
    if ($aState == self::$StateCreateUser)
    {
      $this->setState(self::$StateRoleIsJury);
      $wasEventProcessed = true;
    }
    return $wasEventProcessed;
  }

  public function ExpoTeam()
  {
    $wasEventProcessed = false;
    
    $aState = $this->state;
    if ($aState == self::$StateCreateUser)
    {
      $this->setState(self::$StateRoleIsExpoTeam);
      $wasEventProcessed = true;
    }
    return $wasEventProcessed;
  }

  public function UpdateAnEvent()
  {
    $wasEventProcessed = false;
    
    $aState = $this->state;
    if ($aState == self::$StateRoleIsJury)
    {
      $this->setState(self::$StateUpdateEvent);
      $wasEventProcessed = true;
    }
    return $wasEventProcessed;
  }

  public function ViewingScoreboard()
  {
    $wasEventProcessed = false;
    
    $aState = $this->state;
    if ($aState == self::$StateRoleIsJury)
    {
      $this->setState(self::$StateScoreboard);
      $wasEventProcessed = true;
    }
    return $wasEventProcessed;
  }

  public function CreatingAnExpo()
  {
    $wasEventProcessed = false;
    
    $aState = $this->state;
    if ($aState == self::$StateRoleIsExpoTeam)
    {
      $this->setState(self::$StateCreatingExpo);
      $wasEventProcessed = true;
    }
    return $wasEventProcessed;
  }

  public function Vote()
  {
    $wasEventProcessed = false;
    
    $aState = $this->state;
    if ($aState == self::$StateRoleIsSpectator)
    {
      $this->setState(self::$StateVoting);
      $wasEventProcessed = true;
    }
    return $wasEventProcessed;
  }

  public function Finished()
  {
    $wasEventProcessed = false;
    
    $aState = $this->state;
    if ($aState == self::$StateVoting)
    {
      $this->setState(self::$StateDeleting);
      $wasEventProcessed = true;
    }
    elseif ($aState == self::$StateCreatingExpo)
    {
      $this->setState(self::$StateDeleting);
      $wasEventProcessed = true;
    }
    elseif ($aState == self::$StateUpdateEvent)
    {
      $this->setState(self::$StateDeleting);
      $wasEventProcessed = true;
    }
    elseif ($aState == self::$StateScoreboard)
    {
      $this->setState(self::$StateDeleting);
      $wasEventProcessed = true;
    }
    return $wasEventProcessed;
  }

  public function DoingMore()
  {
    $wasEventProcessed = false;
    
    $aState = $this->state;
    if ($aState == self::$StateUpdateEvent)
    {
      $this->setState(self::$StateRoleIsJury);
      $wasEventProcessed = true;
    }
    elseif ($aState == self::$StateScoreboard)
    {
      $this->setState(self::$StateRoleIsJury);
      $wasEventProcessed = true;
    }
    return $wasEventProcessed;
  }

  private function setState($aState)
  {
    $this->state = $aState;
  }

  public function equals($compareTo)
  {
    return $this == $compareTo;
  }

  public function delete()
  {}

}
