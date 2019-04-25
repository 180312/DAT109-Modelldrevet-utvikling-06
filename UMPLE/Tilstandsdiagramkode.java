//%% NEW FILE HVLexpo BEGINS HERE %%

/*PLEASE DO NOT EDIT THIS CODE*/
/*This code was generated using the UMPLE 1.29.1.4448.81a70243a modeling language!*/



// line 2 "model.ump"
// line 40 "model.ump"
public class HVLexpo
{

  //------------------------
  // MEMBER VARIABLES
  //------------------------

  //HVLexpo State Machines
  public enum State { CreateUser, RoleIsJury, RoleIsExpoTeam, RoleIsSpectator, Voting, CreatingExpo, UpdateEvent, Scoreboard, Deleting }
  private State state;

  //------------------------
  // CONSTRUCTOR
  //------------------------

  public HVLexpo()
  {
    setState(State.CreateUser);
  }

  //------------------------
  // INTERFACE
  //------------------------

  public String getStateFullName()
  {
    String answer = state.toString();
    return answer;
  }

  public State getState()
  {
    return state;
  }

  public boolean Spectator()
  {
    boolean wasEventProcessed = false;
    
    State aState = state;
    switch (aState)
    {
      case CreateUser:
        setState(State.RoleIsSpectator);
        wasEventProcessed = true;
        break;
      default:
        // Other states do respond to this event
    }

    return wasEventProcessed;
  }

  public boolean Jury()
  {
    boolean wasEventProcessed = false;
    
    State aState = state;
    switch (aState)
    {
      case CreateUser:
        setState(State.RoleIsJury);
        wasEventProcessed = true;
        break;
      default:
        // Other states do respond to this event
    }

    return wasEventProcessed;
  }

  public boolean ExpoTeam()
  {
    boolean wasEventProcessed = false;
    
    State aState = state;
    switch (aState)
    {
      case CreateUser:
        setState(State.RoleIsExpoTeam);
        wasEventProcessed = true;
        break;
      default:
        // Other states do respond to this event
    }

    return wasEventProcessed;
  }

  public boolean UpdateAnEvent()
  {
    boolean wasEventProcessed = false;
    
    State aState = state;
    switch (aState)
    {
      case RoleIsJury:
        setState(State.UpdateEvent);
        wasEventProcessed = true;
        break;
      default:
        // Other states do respond to this event
    }

    return wasEventProcessed;
  }

  public boolean ViewingScoreboard()
  {
    boolean wasEventProcessed = false;
    
    State aState = state;
    switch (aState)
    {
      case RoleIsJury:
        setState(State.Scoreboard);
        wasEventProcessed = true;
        break;
      default:
        // Other states do respond to this event
    }

    return wasEventProcessed;
  }

  public boolean CreatingAnExpo()
  {
    boolean wasEventProcessed = false;
    
    State aState = state;
    switch (aState)
    {
      case RoleIsExpoTeam:
        setState(State.CreatingExpo);
        wasEventProcessed = true;
        break;
      default:
        // Other states do respond to this event
    }

    return wasEventProcessed;
  }

  public boolean Vote()
  {
    boolean wasEventProcessed = false;
    
    State aState = state;
    switch (aState)
    {
      case RoleIsSpectator:
        setState(State.Voting);
        wasEventProcessed = true;
        break;
      default:
        // Other states do respond to this event
    }

    return wasEventProcessed;
  }

  public boolean Finished()
  {
    boolean wasEventProcessed = false;
    
    State aState = state;
    switch (aState)
    {
      case Voting:
        setState(State.Deleting);
        wasEventProcessed = true;
        break;
      case CreatingExpo:
        setState(State.Deleting);
        wasEventProcessed = true;
        break;
      case UpdateEvent:
        setState(State.Deleting);
        wasEventProcessed = true;
        break;
      case Scoreboard:
        setState(State.Deleting);
        wasEventProcessed = true;
        break;
      default:
        // Other states do respond to this event
    }

    return wasEventProcessed;
  }

  public boolean DoingMore()
  {
    boolean wasEventProcessed = false;
    
    State aState = state;
    switch (aState)
    {
      case UpdateEvent:
        setState(State.RoleIsJury);
        wasEventProcessed = true;
        break;
      case Scoreboard:
        setState(State.RoleIsJury);
        wasEventProcessed = true;
        break;
      default:
        // Other states do respond to this event
    }

    return wasEventProcessed;
  }

  private void setState(State aState)
  {
    state = aState;
  }

  public void delete()
  {}

}
