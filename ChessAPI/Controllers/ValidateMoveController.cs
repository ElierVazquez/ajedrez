using ChessAPI.Model;
using Microsoft.AspNetCore.Mvc;

namespace ChessAPI.Controllers;

[ApiController]
[Route("[controller]")]
public class ValidateMoveController : ControllerBase
{
    private IBoardService _boardService;

    public ValidateMoveController(IBoardService boardService)
    {
        this._boardService = boardService;
    }

    [HttpGet]
    public IActionResult Get(string board, int fromColumn, int fromRow, int toColumn, int toRow)
    {
        try
        {
            if (string.IsNullOrEmpty(board))
                return BadRequest("board no puede ser IsNullOrEmpty");

            var response = _boardService.ValidateMove(board, fromColumn, toColumn, fromRow, toRow);
            return Ok(response);
        }   
        catch (Exception ex)
        {
            return StatusCode(StatusCodes.Status500InternalServerError);
        }     
    }
}
