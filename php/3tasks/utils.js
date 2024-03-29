 class Point {
  constructor(x, y) {
    this.x = x;
    this.y = y;
  }

  dist(point) {
    const dx = this.x - point.x;
    const dy = this.y - point.y;
    return Math.sqrt(dx * dx + dy * dy);
  }
}

 function degToRad(deg) {
  return (Math.PI / 180) * deg;
}

 function radToDeg(rad) {
  return rad * (180 / Math.PI);
}

 function degToLen(deg, center, r) {
  const x = center.x + r * Math.cos(deg);
  const y = center.y + r * Math.sin(deg);
  return new Point(x, y);
}
