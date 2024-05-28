using System;
namespace ChessAPI.Model
{
    public class Movement
    {
        public int fromColumn;
        public int fromRow;
        public int toColumn;
        public int toRow;

        public Movement(){ }

        public Movement(int fromColumn, int fromRow, int toColumn, int toRow)
        {
            this.fromColumn = fromColumn;
            this.fromRow = fromRow;
            this.toColumn = toColumn;
            this.toRow = toRow;
        }
        private bool ValidateRangeNumber(int x)
        {
            return (x >= 0 && x <= 7);
        }
        public bool IsValid()
        {
            bool x1 = ValidateRangeNumber(fromColumn);
            bool x2 = ValidateRangeNumber(fromRow);
            bool x3 = ValidateRangeNumber(toColumn);
            bool x4 = ValidateRangeNumber(toRow);

            return (x1 && x2 && x3 && x4);
        }

        public bool IsSameColumn()
        {
            return fromColumn == toColumn;
        }

        public int RowDistance()
        {
            int rowFactor = this.fromRow - this.toRow;
            return Math.Abs(rowFactor);
        }
    }
}
