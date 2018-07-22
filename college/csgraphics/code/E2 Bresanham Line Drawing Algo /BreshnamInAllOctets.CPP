# include <iostream.h>
# include <conio.h>
# include <graphics.h>
# include <math.h>
void plotline(int x,int y,int x2, int y2, int color);
void main()
{
    int gDriver=DETECT, gMode;
    int x1,x2,y1,y2;

    void Bresenham(int,int,int,int);
    initgraph(&gDriver,&gMode,"c:\\tc\\bgi");

    cout<<endl<<"x1   : ";
    cin>>x1;
    cout<<endl<<"y1   : ";
    cin>>y1;
    cout<<endl<<"x2   : ";
    cin>>x2;
    cout<<endl<<"y2   : ";
    cin>>y2;
    line(320,0,320,480);
    line(0,240,640,240);
    plotline(320+y1,240-x1,320+y2,240-x2,12);
    getch();
}

void plotline(int x,int y,int x2, int y2, int color) {
    int w = x2 - x ;
    int h = y2 - y ;
    int dx1 = 0, dy1 = 0, dx2 = 0, dy2 = 0 ;
    if (w<0) dx1 = -1 ; else if (w>0) dx1 = 1 ;
    if (h<0) dy1 = -1 ; else if (h>0) dy1 = 1 ;
    if (w<0) dx2 = -1 ; else if (w>0) dx2 = 1 ;
    int longest = abs(w) ;
    int shortest = abs(h) ;
    if (!(longest>shortest)) {
        longest = abs(h) ;
        shortest = abs(w) ;
        if (h<0) dy2 = -1 ; else if (h>0) dy2 = 1 ;
        dx2 = 0 ;            
    }
    int numerator = longest >> 1 ;
    for (int i=0;i<=longest;i++) {
        putpixel(x,y,color) ;
        numerator += shortest ;
        if (!(numerator<longest)) {
            numerator -= longest ;
            x += dx1 ;
            y += dy1 ;
        } else {
            x += dx2 ;
            y += dy2 ;
        }
    }
}