namespace ChessAPI.Model
{
    public class King : Piece
    {
        public King(ColorEnum color) : base(color)
        {

        }

        public override int GetScore()
        {
            return int.MaxValue;
        }

        public override MovementType ValidateSpecificRulesForMovement(Movement movement, Piece[,] board)
        {
            return MovementType.ValidNormalMovement;
        }
    }
}