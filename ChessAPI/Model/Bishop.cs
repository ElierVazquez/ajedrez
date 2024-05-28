namespace ChessAPI.Model
{
    public class Bishop : Piece
    {
        public Bishop(ColorEnum color) : base(color)
        {
        }

        public override int GetScore()
        {
            return PieceValues.BishopPieceValue;
        }

        public override MovementType ValidateSpecificRulesForMovement(Movement movement, Piece[,] board)
        {
            var valid = MovementType.ValidNormalMovement;
            int DF = movement.toRow - movement.fromRow;
            int DC = movement.toColumn - movement.fromColumn;

            if (Math.Abs(DF) != Math.Abs(DC))
                return MovementType.InvalidNormalMovement;

            int FactorF = DF / Math.Abs(DF);
            int FactorC = DC / Math.Abs(DC);

            int i = 1;
            while ((valid==MovementType.ValidNormalMovement) && (i <= Math.Abs(DF) - 1))
            {
                if (board[movement.fromRow + (i * FactorF), movement.fromColumn + i * FactorC] != null)
                    valid = MovementType.InvalidNormalMovement;
                i++;
            }

            return valid;
        }
    }
}