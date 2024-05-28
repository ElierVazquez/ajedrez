using ChessAPI.Model;

public interface IBoardService
{
    BoardScore GetScore(string board);

    Move ValidateMove(string board, int fromCol, int toCol, int fromRow, int toRow);
}