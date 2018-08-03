// import React from 'react'
// import OneComment from './onecomment'

//check if comment is parent or child 
class AllComments extends React.Component {
    render (){
        console.log(this.props)
        let {commentsArray} = this.props
        
        const allComments = commentsArray.map((comment, i ) => {

            return <OneComment addComment={this.props.addComment} comment={comment} index={i} key={i} deleteFunc={this.props.deleteFunc} editHandler={this.props.editHandler}/> 
        })
            
        return(
            <div>
                {allComments}
            </div>
        )
    }
}

// export default AllComments