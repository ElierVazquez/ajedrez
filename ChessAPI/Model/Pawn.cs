namespace ChessAPI.Model
{
    public class Pawn : Piece
    {
        public bool _firstMove;

        public Pawn(ColorEnum color, bool firstMove) : base(color)
        {
            _firstMove = firstMove;
        }

        public override int GetScore()
        {
            return PieceValues.PawnPieceValue;
        }

        public override MovementType ValidateSpecificRulesForMovement(Movement movement, Piece[,] board)
        {
            
            if (_color == Piece.ColorEnum.WHITE)
            {
                if (_firstMove && (movement.toRow-movement.fromRow) == -2)
                {
                    return MovementType.ValidNormalMovement;
                }
                else if ((movement.toRow-movement.fromRow) == -1)
                {
                    return MovementType.ValidNormalMovement;
                }
            }
            else if (_color == Piece.ColorEnum.BLACK)
            {
                if (_firstMove && (movement.toRow-movement.fromRow) == 2)
                {
                    return MovementType.ValidNormalMovement;
                }
                else if ((movement.toRow-movement.fromRow) == 1)
                {
                    return MovementType.ValidNormalMovement;
                }
            }

            return MovementType.InvalidNormalMovement;
        }
    }
}