using ChessAPI.Model;

public class BoardService : IBoardService
{
    public BoardScore  GetScore(string board)
    {
        Board b  = new Board(board);
        var score = b.GetScore();

        return score;
    }

    public Move ValidateMove(string board, int fromCol, int toCol, int fromRow, int toRow)
    {
        Board b  = new Board(board);
        var validate = b.ValidateMove(fromCol, fromRow, toCol, toRow);

        return validate;
    }
}