namespace ChessAPI.Model
{
    public abstract class Piece
    {
        public enum ColorEnum { WHITE, BLACK }
        public readonly ColorEnum _color;
        public virtual String GetCode()
        {
            string code = this.GetType().Name.Substring(0,2).ToUpper();
            string color = this._color.ToString().Substring(0,2).ToUpper();
            return $"|{code}{color}|";
        }

        public abstract int GetScore();

        public Piece(ColorEnum color)
        {
            _color = color;
        }

        public abstract MovementType ValidateSpecificRulesForMovement(Movement movement, Piece[,] board);

        //Movimiento normal valido, movimiento no valido, enroque corto, enroque largo, al paso
        public enum MovementType { ValidNormalMovement, InvalidNormalMovement, PawnPassant }

        public virtual MovementType Validate(Movement movement, Piece[,] board)
        {
            if (!ValidateBasicRulesForMovement(movement, board))
                return MovementType.InvalidNormalMovement;

            return ValidateSpecificRulesForMovement(movement, board);

        }
        public virtual bool ValidateBasicRulesForMovement(Movement movement, Piece[,] board)
        {
            if ((movement.fromRow != movement.toRow) || (movement.fromColumn != movement.toColumn))
                if ((board[movement.toRow, movement.toColumn] == null) ||
                        (board[movement.fromRow, movement.fromColumn]._color != board[movement.toRow, movement.toColumn]._color))
                {
                    return true;
                }

            return false;
        }
    }
}