import pandas as pd
import seaborn as sns
from sklearn.cross_validation import train_test_split
from sklearn.linear_model import LinearRegression
from sklearn import metrics
import numpy as np

data = pd.read_csv('/home/aviral/specialMess.csv')
sns.pairplot(data, x_vars=['Date','Special Food Score','N. Non Veg Food Score'], y_vars='Dinner Strength')

feature_cols = ['Special Food Score', 'N. Non Veg Food Score']
'''
I tried to include the Date as well, thinking that the early periods of the month will let students order food more as they'd be having more money and during the end, they will be drained out and 
so eating from mess would be the only option available to them. Then I calculated RMSE for both the scenarios: date and w/o date. RMSE got lessesed to 90 from 95 upon removing
the date factor. Therefore, I hardly think that this factor would matter.
'''
x = data[feature_cols]
#print (x.head())
#print (type(x))
#print (x.shape)

y = data['Dinner Strength']
#print (y.head())

X_train, X_test, y_train, y_test = train_test_split(x,y,random_state = 1)
#print (X_train.shape)
#print (y_train.shape)
#print (X_test.shape)
#print (y_test.shape)

linreg = LinearRegression()
linreg.fit(X_train, y_train)					#fit should be called in order to activate intercept_ and coef_ attributes of linreg
#print (linreg.fit(X_train, y_train))

#print (linreg.intercept_)						#any attribute that has been estimated from the data should be ended up with _
#print (linreg.coef_)

zip(feature_cols, linreg.coef_)
# print (zip)

y_pred = linreg.predict(X_test)
#print (len(y_pred))
print (y_pred)
pred = [443.04426172, 416.92390693, 484.96982277, 483.74625991, 432.62054734, 378.20571434, 448.80442821, 426.41906807]
true = [460, 520, 545, 445, 585, 645, 400, 360]
#print (metrics.mean_absolute_error(true, pred))
mae = metrics.mean_absolute_error(true, pred)
#print (metrics.mean_squared_error(true, pred))
mse = metrics.mean_squared_error(true, pred)
#print (np.sqrt(metrics.mean_squared_error(true, pred)))
rmse = np.sqrt(metrics.mean_squared_error(true, pred))
rmse_y = np.sqrt(metrics.mean_squared_error(y_test, y_pred))
print (rmse_y)
