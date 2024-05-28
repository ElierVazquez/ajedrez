public class BoardScore
{
    private int _materialValorWhite = 0;

        private int _materialValorBlack = 0;

        private string _messageDist = "";

        public BoardScore(int materialValorWhite, int materialValorBlack, string messageDist)
        {
            this._materialValorWhite = materialValorWhite;
            this._materialValorBlack = materialValorBlack;
            this._messageDist = messageDist;
        }

        public int GetMaterialValorWhite { get => _materialValorWhite; set => _materialValorWhite = value;}

        public int GetMaterialValorBlack { get => _materialValorBlack; set => _materialValorBlack = value;}

        public string GetMessageDist { get => _messageDist; set => _messageDist = value;}
}