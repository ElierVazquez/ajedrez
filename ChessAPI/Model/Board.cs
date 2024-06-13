namespace ChessAPI.Model
{
    public class Board
    {
        private Piece[,] _boardPieces;

        public Board(string board)
        {
            _boardPieces = new Piece[8,8];
            List<string> pieces = new List<string>();
            string[] stringAux;
            string[] auxArray;

            stringAux = board.Split("_");

            for (int i = 0; i < stringAux.GetLength(0); i++)
            {
                auxArray = stringAux[i].Split(",");
                
                for (int j = 0; j < auxArray.GetLength(0); j++) {
                    pieces.Add(auxArray[j]);
                }
            }

            int contList = 0;

            for (int row = 0; row < _boardPieces.GetLength(0); row++)
            {
                for (int col = 0; col < _boardPieces.GetLength(1); col++)
                {
                    if (pieces[contList] == "ROBL")
                    {
                        _boardPieces[row, col] = new Rook(Piece.ColorEnum.BLACK);
                    }
                    else if (pieces[contList] == "ROWH")
                    {
                        _boardPieces[row, col] = new Rook(Piece.ColorEnum.WHITE);
                    }
                    else if (pieces[contList] == "KNBL")
                    {
                        _boardPieces[row, col] = new Knight(Piece.ColorEnum.BLACK);
                    }
                    else if (pieces[contList] == "KNWH")
                    {
                        _boardPieces[row, col] = new Knight(Piece.ColorEnum.WHITE);
                    }
                    else if (pieces[contList] == "BIBL")
                    {
                        _boardPieces[row, col] = new Bishop(Piece.ColorEnum.BLACK);
                    }
                    else if (pieces[contList] == "BIWH")
                    {
                        _boardPieces[row, col] = new Bishop(Piece.ColorEnum.WHITE);
                    }
                    else if (pieces[contList] == "QUBL")
                    {
                        _boardPieces[row, col] = new Queen(Piece.ColorEnum.BLACK);
                    }
                    else if (pieces[contList] == "QUWH")
                    {
                        _boardPieces[row, col] = new Queen(Piece.ColorEnum.WHITE);
                    }
                    else if (pieces[contList] == "KIBL")
                    {
                        _boardPieces[row, col] = new King(Piece.ColorEnum.BLACK);
                    }
                    else if (pieces[contList] == "KIWH")
                    {
                        _boardPieces[row, col] = new King(Piece.ColorEnum.WHITE);
                    }
                    else if (pieces[contList] == "PABL")
                    {
                        _boardPieces[row, col] = new Pawn(Piece.ColorEnum.BLACK);
                    }
                    else if (pieces[contList] == "PAWH")
                    {
                        _boardPieces[row, col] = new Pawn(Piece.ColorEnum.WHITE);
                    }
                    contList++;
                }
            }

        } 

        public BoardScore GetScore()
        {
            int contWhite = 0;
            int contBlack = 0;
            string message = "";
            int distance = 0;

            string[] boardPiecesW = {"|ROWH|", "|BIWH|", "|KNWH|", "|PAWH|", "|QUWH|"};
            string[] boardPiecesB = {"|ROBL|", "|BIBL|", "|KNBL|", "|PABL|", "|QUBL|"};

            for (int row = 0; row < _boardPieces.GetLength(0); row++)
            {
                for (int col = 0; col < _boardPieces.GetLength(1); col++)
                {
                    Piece pieceAux = _boardPieces[row, col];
                    if (pieceAux != null && pieceAux.GetCode() != "|KIWH|" && pieceAux.GetCode() != "|KIBL|")
                    {
                        if (boardPiecesW.Contains(pieceAux.GetCode()))
                        {
                            contWhite += pieceAux.GetScore();
                        } else if (boardPiecesB.Contains(pieceAux.GetCode())) {
                            contBlack += pieceAux.GetScore();
                        }
                    }
                }
            }

            distance = Math.Abs(contBlack-contWhite);
            string plural = "";

            if (distance > 1)
            {
                plural = " points.";
            }
            else
            {
                plural = " point.";
            }
            
            if (contWhite > contBlack)
            {
                message = "White is winning by " + distance + plural;
            } 
            else if (contBlack > contWhite)
            {
                message = "Black is winning by " + distance + plural;
            }
            else 
            {
                message = "Draw";
            }

            return new BoardScore(contWhite, contBlack, message);

        }

        public Move ValidateMove(int fromColumn, int fromRow, int toColumn, int toRow, int turn, int promotion)
        {
            Movement move = new Movement(fromColumn, fromRow, toColumn, toRow);
            Piece piece = _boardPieces[fromRow, fromColumn];

            if (turn % 2 == 0 && piece._color == Piece.ColorEnum.BLACK)
            {
                return new Move(false, GetBoardState(), "Invalid Movement");
            }
            else if (turn % 2 != 0 && piece._color == Piece.ColorEnum.WHITE)
            {
                return new Move(false, GetBoardState(), "Invalid Movement");
            }

            try
            {
                if (move.IsValid())
                {
                    if (piece.Validate(move, _boardPieces) != Piece.MovementType.InvalidNormalMovement)
                    {
                        _boardPieces[toRow, toColumn] = _boardPieces[fromRow, fromColumn];
                        _boardPieces[fromRow, fromColumn] = null;

                        PromotePawnControl(toRow, toColumn, promotion);

                        return new Move(true, GetBoardState(), "OK");
                    }
                }

                return new Move(false, GetBoardState(), "Invalid Movement");
            }
            catch (Exception ex)
            {
                return new Move(false, GetBoardState(), ex.Message);
            }
        }

        public void PromotePawnControl(int row, int column, int promotion)
        {
            if (_boardPieces[row, column].GetScore() == PieceValues.PawnPieceValue)
            {
                if ((_boardPieces[row, column]._color == Piece.ColorEnum.WHITE && row == 0) || (_boardPieces[row, column]._color == Piece.ColorEnum.BLACK && row == 7))
                {
                    _boardPieces[row, column] = ChoosePromotion(_boardPieces[row, column]._color, promotion);
                }
            }
        }

        private Piece ChoosePromotion(Piece.ColorEnum color, int promotion)
        {
            switch (promotion)
            {
                case 1:
                    return new Queen(color);
                case 2:
                    return new Knight(color);
                case 3:
                    return new Rook(color);
                case 4:
                    return new Bishop(color);
                default:
                    return new Pawn(color);
            }
        }

        public string GetBoardState()
        {
            string result = string.Empty;

            for (int i = 0; i < _boardPieces.GetLength(0); i++)
            {
                for (int j = 0; j < _boardPieces.GetLength(1); j++)
                {
                    if (_boardPieces[i, j] != null)
                    {
                        result += _boardPieces[i, j].GetCode();
                    }
                    else
                    {
                        result += "0";
                    }

                    if (j == _boardPieces.GetLength(1) - 1)
                    {
                        result += "_";
                    }
                    else
                    {
                        result += ",";
                    }
                }
            }

            result = result.Replace("|", "");
            result = result.Remove(result.Length - 1);
            
            return result;

        }
        
    }
}