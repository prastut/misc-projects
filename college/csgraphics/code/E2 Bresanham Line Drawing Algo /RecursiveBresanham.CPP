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
    plotline(x1,y1,x2,y2,12);
    getch();
}

void plotline(int x,int y,int x2, int y2, int color) {
    if( abs(x-x2)== 1 && abs(y-y2)==1 )
        return;
    else
    {
        int midX = (x+x2)/2;
        int midY = (y+y2)/2;
        putpixel(320+y,240-x,color);
        putpixel(320+y2,240-x2,color);
        putpixel(320+midY,240-midX,color);
        plotline(x,y,midX,midY,color);
        plotline(midX,midY,x2,y2,color);
    }
    return;

}