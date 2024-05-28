public class Move
{
    private bool _valid;
    private string _board;
    private string _status;

    public Move(bool valid, string board, string status)
    {
        this._valid = valid;
        this._board = board;
        this._status = status;
    }

    public bool valid {get => _valid; set => _valid = value;}

    public string board {get => _board; set => _board = value;}

    public string status {get => _status; set => _status = value;}
}