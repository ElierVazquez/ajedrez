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
            int dx = Math.Abs(movement.toColumn-movement.fromColumn);
            int dy = Math.Abs(movement.toRow-movement.fromRow);

            if ((dx == 1 && dy == 0) || (dx == 0 && dy == 1) || (dx == 1 && dy == 1))
            {
                return MovementType.ValidNormalMovement;
            }

            return MovementType.InvalidNormalMovement;
        }
    }
}