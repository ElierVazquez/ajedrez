namespace ChessAPI.Model
{
    public class Pawn : Piece
    {
        public Pawn(ColorEnum color) : base(color)
        {
        }

        public override int GetScore()
        {
            return PieceValues.PawnPieceValue;
        }

        public override MovementType ValidateSpecificRulesForMovement(Movement movement, Piece[,] board)
        {
            bool baseMovement = BaseMovement(movement, board);
            if (baseMovement)
                return MovementType.ValidNormalMovement;

            bool kill = Kill(movement, board);

            if (kill)
                return MovementType.ValidNormalMovement;


            bool initialMovement = InitialMovement(movement, board);

            if (initialMovement)
                return MovementType.ValidNormalMovement;

            return MovementType.InvalidNormalMovement;
        }

        public bool BaseMovement(Movement movement, Piece[,] board)
        {
            bool result = false;

            if ((movement.RowDistance()==1) && 
                (movement.IsSameColumn()) && board[movement.toRow,movement.toColumn]==null)
            {
                if (this._color==ColorEnum.WHITE)
                    result = movement.toRow < movement.fromRow;
                else
                    result = movement.toRow > movement.fromRow;
            }

            return result;

        }
        public bool Kill(Movement movement, Piece[,] board)
        {
            bool result = false;
            int columnFactor = movement.fromColumn - movement.toColumn;
            
            if (board[movement.toRow, movement.toColumn] != null)
            {
                if ((movement.RowDistance() == 1) && (Math.Abs(columnFactor) == 1))
                {
                    if (this._color == ColorEnum.WHITE)
                        result = movement.toRow < movement.fromRow;
                    else
                        result = movement.toRow > movement.fromRow;
                }
            }

            return result;
        }

        public bool InitialMovement(Movement movement, Piece[,] board)
        {
            bool result = false;

            if ((board[movement.toRow,movement.toColumn]==null) && (movement.RowDistance() == 2) && movement.IsSameColumn() && ((movement.fromRow==1) || (movement.fromRow==6)))
            {
                if (this._color == ColorEnum.WHITE)
                    result = board[5, movement.toColumn] == null;
                else
                    result = board[2, movement.toColumn] == null;
  
            }

            return result;
        }
    }
}