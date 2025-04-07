<?php
$score = isset($_POST['score']) ? intval($_POST['score']) : 0;
$action = isset($_POST['action']) ? $_POST['action'] : 'roll';
$message = "";
$showImage = false;
$playSound = false;

if ($action === "roll") {
    $die1 = rand(1, 6);
    $die2 = rand(1, 6);
    $roll = $die1 + $die2;
    $score += $roll;
    if ($score > 21) {
        $message = "You rolled $die1 and $die2 (Total: $roll). Your total is $score. Bust! 💥";
    } elseif ($score == 21) {
        $message = "Perfect roll! Your total is 21. Stand now to win!";
    } else {
        $message = "You rolled $die1 and $die2 (Total: $roll). Current score: $score.";
    }
} elseif ($action === "stand") {
    if ($score == 21) {
        $message = "You stood on 21! You win! 🎉";
        $showImage = true;
        $playSound = true;
    } else {
        $message = "You stood on $score. That's not 21. You lose! ❌";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Dice Blackjack</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <h1>🎲 Dice Blackjack 🎲</h1>
  <p><?= $message ?></p>

  <?php if ($showImage): ?>
    <img src="KŘESADLO.jpg" alt="You Win!">
  <?php endif; ?>

  <?php if ($playSound): ?>
    <audio autoplay>
      <source src="KŘESADLO!!!.mp3" type="audio/mpeg">
      Your browser does not support the audio element.
    </audio>
  <?php endif; ?>

  <?php if ($score < 21 && $action !== "stand"): ?>
    <form action="game.php" method="post">
      <input type="hidden" name="score" value="<?= $score ?>">
      <button type="submit" name="action" value="roll">Roll</button>
      <button type="submit" name="action" value="stand">Stand</button>
    </form>
  <?php else: ?>
    <form action="index.html">
      <button type="submit">Play Again</button>
    </form>
  <?php endif; ?>
</body>
</html>

