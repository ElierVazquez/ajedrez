namespace ChessAPI.Model
{
    public class Knight : Piece
    {
        public Knight(ColorEnum color) : base(color)
        {

        }

        public override int GetScore()
        {
            return PieceValues.KnightPieceValue;
        }

        public override MovementType ValidateSpecificRulesForMovement(Movement movement, Piece[,] board)
        {
            if ((Math.Abs(movement.toRow-movement.fromRow) == 2 && Math.Abs(movement.toColumn-movement.fromColumn) == 1) || (Math.Abs(movement.toRow-movement.fromRow) == 1 && Math.Abs(movement.toColumn-movement.fromColumn) == 2))
            {
                return MovementType.ValidNormalMovement;
            }

            return MovementType.InvalidNormalMovement;
        }
    }
}