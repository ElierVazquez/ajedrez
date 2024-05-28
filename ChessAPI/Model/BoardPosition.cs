namespace ChessAPI.Model
{
    public class BoardPosition
    {
        private int _row;
        private int _column;

        public int Row
        {
            get { return _row; }
            set
            {
                if (!ValidateRangeNumber(value))
                    throw new ArgumentOutOfRangeException(nameof(value),"The valid range is between 0 and 7.");

                _row = value;
            }
        }
        public int Column
        {
            get { return _column; }
            set
            {
                if (!ValidateRangeNumber(value))
                    throw new ArgumentOutOfRangeException(nameof(value),"The valid range is between 0 and 7.");

                _column = value;
            }
        }

        private bool ValidateRangeNumber(int x)
        {
            return (x >= 0 && x <= 7);
        }

        private BoardPosition()
        {}

        public BoardPosition(int row, int column)
        {
            if (ValidateRangeNumber(row))
                _row = row;
            else
                throw new ArgumentOutOfRangeException(nameof(row),"The valid range is between 0 and 7.");

                
            if (ValidateRangeNumber(column))
                _column = column;
            else
                throw new ArgumentOutOfRangeException(nameof(column),"The valid range is between 0 and 7.");
        }
    }
}