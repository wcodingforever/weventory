import numpy as np
import matplotlib.pyplot as plt
# import matplotlib as mpl

# BEST WAY
# x(from zero, to max days), y(total working hours, to zero)
plt.plot([0, 11], [168,0], 'og--')
# WORST WAY
# x(from zero, to max days), y(total working hours, to zero)
plt.plot([0, 13], [168,0], 'or--') 
# NOW EFFORT
# x(...), y(...)

plt.plot([0, 1, 2, 3, 4], [168,155,135,108,92], 'ob-') 

# LEFT
# x(days), y(hoursLeft)
plt.plot([0, 1, 2, 3, 4], [168,164,144,126,110], 'oc-') 

# DAILY WRKDONE
days = (0,1,2,3,4,5,6,7,8,9,10,11,12,13,14)
workdone = [4, 20, 18, 16, 0 ,0 ,0 ,0 ,0 ,0, 0, 0, 0, 0, 0]
y_pos = np.arange(len(days))
plt.bar(y_pos, workdone, width=0.5, color="yellow",edgecolor = "black") 
plt.xticks(y_pos, days)

# AXIS
plt.grid()
plt.axis([0,15,0,200])
plt.xlabel('Days')
plt.ylabel('Remaining effort (hours)')
plt.title('Burn-down chart')

#SHOW
plt.show()
